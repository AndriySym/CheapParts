import { useEffect, useState } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import { productsAPI, cartAPI } from '../lib/api';
import type { Product } from '../types';

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
      alert('Producto añadido al carrito');
    } catch (err) {
      alert('Error al añadir al carrito');
      console.error(err);
    } finally {
      setAdding(false);
    }
  };

  if (loading) return <div className="text-center py-8">Cargando...</div>;
  if (error || !product) return <div className="text-red-500 text-center py-8">{error}</div>;

  return (
    <div className="container mx-auto px-4 py-8">
      <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div>
          {product.image_url && (
            <img
              src={`http://localhost:8000${product.image_url}`}
              alt={product.name}
              className="w-full rounded shadow-lg"
            />
          )}
        </div>
        <div>
          <h1 className="text-3xl font-bold mb-4">{product.name}</h1>
          <p className="text-gray-600 text-lg mb-2">{product.brand}</p>
          <p className="text-sm text-gray-500 mb-4">{product.category}</p>
          <p className="text-3xl font-bold text-blue-600 mb-6">
            {(product.price_cents / 100).toFixed(2)} €
          </p>
          <p className="text-gray-700 mb-6">{product.description}</p>
          <div className="mb-6">
            <p className="text-sm mb-2">
              Stock disponible: <span className="font-semibold">{product.stock}</span>
            </p>
            <div className="flex items-center gap-4 mb-4">
              <label className="font-medium">Cantidad:</label>
              <div className="flex items-center gap-2">
                <button
                  onClick={() => setQuantity(Math.max(1, quantity - 1))}
                  className="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300"
                >
                  -
                </button>
                <span className="px-4">{quantity}</span>
                <button
                  onClick={() => setQuantity(Math.min(product.stock, quantity + 1))}
                  className="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300"
                >
                  +
                </button>
              </div>
            </div>
          </div>
          <button
            onClick={addToCart}
            disabled={adding || product.stock === 0}
            className="w-full bg-blue-500 text-white py-3 rounded text-lg hover:bg-blue-600 disabled:bg-gray-400"
          >
            {adding ? 'Añadiendo...' : product.stock === 0 ? 'Sin Stock' : 'Añadir al Carrito'}
          </button>
        </div>
      </div>
    </div>
  );
}

