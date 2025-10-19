import { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { cartAPI } from '../lib/api';
import type { CartItem } from '../types';

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
    } catch (err) {
      console.error('Error al actualizar cantidad', err);
    }
  };

  const removeItem = async (itemId: number) => {
    try {
      await cartAPI.removeItem(itemId);
      await loadCart();
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

  if (loading) return <div className="text-center py-8">Cargando...</div>;
  if (error) return <div className="text-red-500 text-center py-8">{error}</div>;

  if (cartItems.length === 0) {
    return (
      <div className="container mx-auto px-4 py-8 text-center">
        <h1 className="text-3xl font-bold mb-6">Carrito de Compra</h1>
        <p className="text-gray-600 mb-4">Tu carrito está vacío</p>
        <button
          onClick={() => navigate('/products')}
          className="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600"
        >
          Ver Productos
        </button>
      </div>
    );
  }

  return (
    <div className="container mx-auto px-4 py-8">
      <h1 className="text-3xl font-bold mb-6">Carrito de Compra</h1>
      <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div className="lg:col-span-2 space-y-4">
          {cartItems.map((item) => (
            <div key={item.id} className="border rounded p-4 flex gap-4">
              {item.product.image_url && (
                <img
                  src={`http://localhost:8000${item.product.image_url}`}
                  alt={item.product.name}
                  className="w-24 h-24 object-cover rounded"
                />
              )}
              <div className="flex-grow">
                <h3 className="font-semibold text-lg">{item.product.name}</h3>
                <p className="text-gray-600 text-sm">{item.product.brand}</p>
                <p className="text-blue-600 font-bold mt-2">
                  {(item.product.price_cents / 100).toFixed(2)} €
                </p>
              </div>
              <div className="flex flex-col items-end gap-2">
                <div className="flex items-center gap-2">
                  <button
                    onClick={() => updateQuantity(item.id, Math.max(1, item.quantity - 1))}
                    className="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300"
                  >
                    -
                  </button>
                  <span className="px-4">{item.quantity}</span>
                  <button
                    onClick={() => updateQuantity(item.id, item.quantity + 1)}
                    className="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300"
                  >
                    +
                  </button>
                </div>
                <button
                  onClick={() => removeItem(item.id)}
                  className="text-red-500 text-sm hover:underline"
                >
                  Eliminar
                </button>
                <p className="text-sm font-semibold mt-2">
                  Subtotal: {((item.product.price_cents * item.quantity) / 100).toFixed(2)} €
                </p>
              </div>
            </div>
          ))}
        </div>
        <div className="border rounded p-6 h-fit sticky top-4">
          <h2 className="text-xl font-bold mb-4">Resumen del Pedido</h2>
          <div className="space-y-2 mb-4">
            <div className="flex justify-between">
              <span>Productos ({cartItems.length})</span>
              <span>{(calculateTotal() / 100).toFixed(2)} €</span>
            </div>
            <div className="flex justify-between font-bold text-lg border-t pt-2">
              <span>Total</span>
              <span>{(calculateTotal() / 100).toFixed(2)} €</span>
            </div>
          </div>
          <button className="w-full bg-blue-500 text-white py-3 rounded hover:bg-blue-600">
            Proceder al Pago
          </button>
        </div>
      </div>
    </div>
  );
}

