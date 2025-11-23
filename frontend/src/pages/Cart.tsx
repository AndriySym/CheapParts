import { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { cartAPI, paymentAPI } from '../lib/api';
import type { CartItem } from '../types';
import Swal from 'sweetalert2';

// Función para traducir categorías
const translateCategory = (category: string): string => {
  const translations: Record<string, string> = {
    'CPU': 'Procesadores',
    'GPU': 'Tarjetas Gráficas',
    'RAM': 'Memoria RAM',
    'Storage': 'Almacenamiento',
    'Motherboard': 'Placas Base',
    'PSU': 'Fuentes de Alimentación',
    'Case': 'Cajas',
    'Cooling': 'Refrigeración',
    'Peripherals': 'Periféricos',
    'Monitor': 'Monitores'
  };
  return translations[category] || category;
};

export default function Cart() {
  const [cartItems, setCartItems] = useState<CartItem[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const navigate = useNavigate();

  useEffect(() => {
    const token = localStorage.getItem('auth_token');
    if (!token) {
      navigate('/login');
      return;
    }
    loadCart();
  }, [navigate]);

  const loadCart = async () => {
    try {
      setLoading(true);
      const response = await cartAPI.getItems();
      setCartItems(response.data);
    } catch (err) {
      setError('Error al cargar el carrito');
      console.error(err);
    } finally {
      setLoading(false);
    }
  };

  const updateQuantity = async (itemId: number, quantity: number) => {
    try {
      await cartAPI.updateItem(itemId, { quantity });
      await loadCart();
      // Emitir evento para actualizar el contador del carrito
      window.dispatchEvent(new CustomEvent('cartUpdated'));
    } catch (err: any) {
      if (err.response?.data?.error === 'stock_insufficient') {
        await Swal.fire({
          icon: 'warning',
          title: 'Stock Insuficiente',
          text: err.response.data.message || 'No hay suficiente stock disponible para este producto.',
          confirmButtonColor: '#3085d6',
        });
        // Recargar el carrito para actualizar las cantidades
        await loadCart();
      } else {
        await Swal.fire({
          icon: 'error',
          title: 'Error',
          text: err.response?.data?.message || 'Error al actualizar la cantidad',
        });
      }
    }
  };

  const removeItem = async (itemId: number) => {
    try {
      await cartAPI.removeItem(itemId);
      await loadCart();
      // Emitir evento para actualizar el contador del carrito
      window.dispatchEvent(new CustomEvent('cartUpdated'));
    } catch (err) {
      console.error('Error al eliminar item', err);
    }
  };

  const calculateTotal = () => {
    return cartItems.reduce(
      (total, item) => total + item.product.price_cents * item.quantity,
      0
    );
  };

  const handleCheckout = async () => {
    try {
      setLoading(true);
      
      // Formatear items del carrito para Stripe
      const items = cartItems.map(item => ({
        name: item.product.name,
        price_cents: item.product.price_cents,
        quantity: item.quantity,
        brand: item.product.brand,
      }));
      
      const response = await paymentAPI.createCheckoutSession(items);
      // Redirigir a Stripe Checkout
      window.location.href = response.data.url;
    } catch (err: any) {
      setError(err.response?.data?.error || 'Error al procesar el pago');
      console.error('Error al crear sesión de checkout', err);
      setLoading(false);
    }
  };

  if (loading && cartItems.length === 0) return <div className="text-center py-8">Cargando...</div>;
  if (error && !loading) return <div className="text-red-500 text-center py-8">{error}</div>;

  if (cartItems.length === 0) {
    return (
      <div className="container mx-auto px-4 py-16">
        <div className="max-w-md mx-auto text-center bg-white rounded-lg shadow-lg p-12">
          <div className="text-6xl mb-6">🛒</div>
          <h1 className="text-3xl font-bold mb-4 text-gray-800">Carrito Vacío</h1>
          <p className="text-gray-600 mb-8">Aún no has añadido productos a tu carrito</p>
          <button
            onClick={() => navigate('/products')}
            className="bg-blue-600 text-white px-8 py-3 rounded-lg text-lg font-semibold hover:bg-blue-700 transition transform hover:scale-105"
          >
            🛍️ Explorar Productos
          </button>
        </div>
      </div>
    );
  }

  return (
    <div className="container mx-auto px-4 py-8">
      <h1 className="text-3xl font-bold mb-6">Carrito de Compra</h1>
      <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div className="lg:col-span-2 space-y-4">
          {cartItems.map((item) => (
            <div key={item.id} className="bg-white border border-gray-200 rounded-lg p-4 flex gap-4 hover:shadow-md transition">
              {item.product.image_url && (
                <div className="w-28 h-28 flex-shrink-0 bg-white border border-gray-100 rounded-lg p-2 flex items-center justify-center">
                  <img
                    src={`http://localhost:8000${item.product.image_url!}`}
                    alt={item.product.name}
                    className="max-w-full max-h-full object-contain"
                    onError={(e) => {
                      const target = e.target as HTMLImageElement;
                      target.style.display = 'none';
                      const placeholder = target.nextElementSibling as HTMLElement;
                      if (placeholder) placeholder.style.display = 'flex';
                    }}
                  />
                  <div className="hidden absolute inset-0 bg-gray-100 flex items-center justify-center text-gray-400 text-2xl">
                    📦
                  </div>
                </div>
              )}
              <div className="flex-grow">
                <span className="inline-block px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs mb-2">
                  {translateCategory(item.product.category)}
                </span>
                <h3 className="font-semibold text-lg mb-1">{item.product.name}</h3>
                <p className="text-gray-600 text-sm mb-2">{item.product.brand}</p>
                <p className="text-blue-600 font-bold text-xl">
                  {(item.product.price_cents / 100).toFixed(2)} €
                </p>
              </div>
              <div className="flex flex-col items-end justify-between gap-2">
                <div className="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                  <button
                    onClick={() => updateQuantity(item.id, Math.max(1, item.quantity - 1))}
                    className="px-3 py-2 bg-gray-100 hover:bg-gray-200 transition"
                  >
                    −
                  </button>
                  <span className="px-4 py-2 font-semibold min-w-[3rem] text-center">{item.quantity}</span>
                  <button
                    onClick={() => updateQuantity(item.id, item.quantity + 1)}
                    className="px-3 py-2 bg-gray-100 hover:bg-gray-200 transition"
                  >
                    +
                  </button>
                </div>
                <button
                  onClick={() => removeItem(item.id)}
                  className="text-red-600 text-sm font-medium hover:text-red-700 hover:underline"
                >
                  🗑️ Eliminar
                </button>
                <div className="text-right mt-auto">
                  <p className="text-xs text-gray-500">Subtotal</p>
                  <p className="text-lg font-bold text-gray-800">
                    {((item.product.price_cents * item.quantity) / 100).toFixed(2)} €
                  </p>
                </div>
              </div>
            </div>
          ))}
        </div>
        <div className="bg-white border border-gray-200 rounded-lg p-6 h-fit sticky top-4 shadow-sm">
          <h2 className="text-2xl font-bold mb-6 text-gray-800">Resumen del Pedido</h2>
          <div className="space-y-3 mb-6">
            <div className="flex justify-between text-gray-600">
              <span>Productos ({cartItems.length})</span>
              <span className="font-semibold">{(calculateTotal() / 100).toFixed(2)} €</span>
            </div>
            <div className="flex justify-between text-gray-600">
              <span>Envío</span>
              <span className="text-green-600 font-semibold">GRATIS</span>
            </div>
            <div className="border-t-2 border-gray-200 pt-3 flex justify-between font-bold text-2xl text-gray-800">
              <span>Total</span>
              <span className="text-blue-600">{(calculateTotal() / 100).toFixed(2)} €</span>
            </div>
          </div>
          <button
            onClick={handleCheckout}
            disabled={loading}
            className="w-full bg-blue-600 text-white py-4 rounded-lg text-lg font-semibold hover:bg-blue-700 disabled:bg-gray-400 disabled:cursor-not-allowed transition transform hover:scale-105 shadow-md"
          >
            {loading ? '⏳ Procesando...' : '💳 Proceder al Pago'}
          </button>
          <p className="text-xs text-gray-500 text-center mt-4">
            🔒 Pago seguro procesado por Stripe
          </p>
        </div>
      </div>
    </div>
  );
}

