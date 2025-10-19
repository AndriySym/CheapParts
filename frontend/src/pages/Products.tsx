import { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import { productsAPI } from '../lib/api';
import type { Product } from '../types';

interface PaginationMeta {
  current_page: number;
  last_page: number;
  per_page: number;
  total: number;
}

export default function Products() {
  const [products, setProducts] = useState<Product[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [pagination, setPagination] = useState<PaginationMeta | null>(null);
  const [currentPage, setCurrentPage] = useState(1);

  useEffect(() => {
    loadProducts(currentPage);
  }, [currentPage]);

  const loadProducts = async (page: number) => {
    try {
      setLoading(true);
      const response = await productsAPI.getAll({ page });
      // Laravel pagination returns data in response.data.data
      const productData = response.data.data || [];
      setProducts(Array.isArray(productData) ? productData : []);
      setPagination({
        current_page: response.data.current_page,
        last_page: response.data.last_page,
        per_page: response.data.per_page,
        total: response.data.total,
      });
    } catch (err) {
      setError('Error al cargar productos');
      console.error(err);
    } finally {
      setLoading(false);
    }
  };

  if (loading) return <div className="text-center py-8">Cargando...</div>;
  if (error) return <div className="text-red-500 text-center py-8">{error}</div>;

  return (
    <div className="container mx-auto px-4 py-8">
      <h1 className="text-3xl font-bold mb-6">Productos</h1>
      <div className="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        {products.map((product) => (
          <Link
            key={product.id}
            to={`/products/${product.id}`}
            className="border rounded p-4 hover:shadow-lg transition"
          >
            {product.image_url && (
              <img
                src={`http://localhost:8000${product.image_url}`}
                alt={product.name}
                className="w-full h-48 object-cover rounded mb-3"
              />
            )}
            <h3 className="font-semibold text-lg mb-2">{product.name}</h3>
            <p className="text-gray-600 text-sm mb-2">{product.brand}</p>
            <p className="text-blue-600 font-bold">
              {(product.price_cents / 100).toFixed(2)} €
            </p>
            <p className="text-sm text-gray-500 mt-2">
              Stock: {product.stock}
            </p>
          </Link>
        ))}
      </div>
      
      {pagination && pagination.last_page > 1 && (
        <div className="flex justify-center gap-2 mt-8">
          <button
            onClick={() => setCurrentPage(p => Math.max(1, p - 1))}
            disabled={currentPage === 1}
            className="px-4 py-2 bg-blue-500 text-white rounded disabled:bg-gray-300"
          >
            Anterior
          </button>
          <span className="px-4 py-2">
            Página {pagination.current_page} de {pagination.last_page}
          </span>
          <button
            onClick={() => setCurrentPage(p => Math.min(pagination.last_page, p + 1))}
            disabled={currentPage === pagination.last_page}
            className="px-4 py-2 bg-blue-500 text-white rounded disabled:bg-gray-300"
          >
            Siguiente
          </button>
        </div>
      )}
    </div>
  );
}

