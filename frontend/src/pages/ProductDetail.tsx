import { useEffect, useState } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import { productsAPI, cartAPI } from '../lib/api';
import type { Product } from '../types';
// @ts-ignore - sweetalert2 types are included in the package
import Swal from 'sweetalert2';

// Función para traducir categorías
const translateCategory = (category: string | null): string => {
  if (!category) return '';
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

export default function ProductDetail() {
  const { id } = useParams();
  const navigate = useNavigate();
  const [product, setProduct] = useState<Product | null>(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [quantity, setQuantity] = useState(1);
  const [adding, setAdding] = useState(false);

  useEffect(() => {
    if (id) {
      loadProduct(parseInt(id));
    }
  }, [id]);

  // Ajustar cantidad si el stock cambia
  useEffect(() => {
    if (product && quantity > product.stock) {
      setQuantity(product.stock > 0 ? product.stock : 1);
    }
  }, [product, quantity]);

  const loadProduct = async (productId: number) => {
    try {
      setLoading(true);
      const response = await productsAPI.getOne(productId);
      setProduct(response.data);
    } catch (err) {
      setError('Producto no encontrado');
      console.error(err);
    } finally {
      setLoading(false);
    }
  };

  const addToCart = async () => {
    const token = localStorage.getItem('auth_token');
    if (!token) {
      navigate('/login');
      return;
    }

    try {
      setAdding(true);
      await cartAPI.addItem({ product_id: product!.id, quantity });
      // Emitir evento personalizado para actualizar el contador del carrito
      window.dispatchEvent(new CustomEvent('cartUpdated'));
      // Recargar el producto para actualizar el stock
      await loadProduct(product!.id);
    } catch (err: any) {
      if (err.response?.data?.error === 'stock_insufficient') {
        await Swal.fire({
          icon: 'warning',
          title: 'Stock Insuficiente',
          text: err.response.data.message || 'No hay suficiente stock disponible para este producto.',
          confirmButtonColor: '#3085d6',
        });
      } else {
        await Swal.fire({
          icon: 'error',
          title: 'Error',
          text: err.response?.data?.message || 'Error al añadir al carrito',
        });
      }
    } finally {
      setAdding(false);
    }
  };

  if (loading) return <div className="text-center py-8">Cargando...</div>;
  if (error || !product) return <div className="text-red-500 text-center py-8">{error}</div>;

  return (
    <div className="container mx-auto px-4 py-8">
      <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div className="bg-white rounded-lg shadow-lg p-8 flex items-center justify-center">
          {product.image_url && (
            <>
              <img
                src={`http://localhost:8000${product.image_url!}`}
                alt={product.name}
                className="max-w-full max-h-96 object-contain"
                onError={(e) => {
                  const target = e.target as HTMLImageElement;
                  target.style.display = 'none';
                  const placeholder = target.nextElementSibling as HTMLElement;
                  if (placeholder) placeholder.style.display = 'flex';
                }}
              />
              <div className="hidden bg-gray-100 flex items-center justify-center text-gray-400 w-full h-96">
                <div className="text-center">
                  <div className="text-6xl mb-4">📦</div>
                  <div className="text-lg">Sin imagen disponible</div>
                </div>
              </div>
            </>
          )}
        </div>
        <div className="bg-white rounded-lg shadow-lg p-8">
          <div className="mb-4">
            <span className="inline-block px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-medium">
              {translateCategory(product.category)}
            </span>
          </div>
          <h1 className="text-3xl font-bold mb-3">{product.name}</h1>
          <p className="text-gray-600 text-lg mb-6">{product.brand}</p>
          <p className="text-4xl font-bold text-blue-600 mb-6">
            {(product.price_cents / 100).toFixed(2)} €
          </p>
          <div className="border-t border-gray-200 pt-6 mb-6">
            <h2 className="font-semibold text-lg mb-3">Descripción</h2>
            <p className="text-gray-700 leading-relaxed">{product.description}</p>
          </div>
          <div className="border-t border-gray-200 pt-6 mb-6">
            <div className="flex items-center justify-between mb-4">
              <span className="text-gray-700 font-medium">Stock disponible:</span>
              <span className={`font-bold ${product.stock > 10 ? 'text-green-600' : product.stock > 0 ? 'text-orange-600' : 'text-red-600'}`}>
                {product.stock > 0 ? `${product.stock} unidades` : 'Agotado'}
              </span>
            </div>
            <div className="flex items-center gap-4">
              <label className="font-medium text-gray-700">Cantidad:</label>
              <div className="flex items-center border border-gray-300 rounded-lg">
                <button
                  onClick={() => setQuantity(Math.max(1, quantity - 1))}
                  className="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-l-lg transition"
                >
                  −
                </button>
                <span className="px-6 py-2 font-semibold">{quantity}</span>
                <button
                  onClick={() => setQuantity(Math.min(product.stock, quantity + 1))}
                  disabled={quantity >= product.stock}
                  className="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-r-lg transition disabled:opacity-50 disabled:cursor-not-allowed"
                >
                  +
                </button>
              </div>
            </div>
          </div>
          <div className="flex gap-3">
            <button
              onClick={addToCart}
              disabled={adding || product.stock === 0}
              className="flex-1 bg-blue-600 text-white py-3 px-6 rounded-lg text-lg font-semibold hover:bg-blue-700 disabled:bg-gray-400 disabled:cursor-not-allowed transition transform hover:scale-105"
            >
              {adding ? 'Añadiendo...' : product.stock === 0 ? 'Sin Stock' : '🛒 Añadir al Carrito'}
            </button>
            <button
              onClick={() => navigate('/products')}
              className="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition"
            >
              ← Volver
            </button>
          </div>
        </div>
      </div>
    </div>
  );
}

