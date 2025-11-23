import { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { ordersAPI, BASE_URL } from '../lib/api';
import type { Order } from '../types';

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

// Función para traducir estado del pedido
const translateStatus = (status: string): string => {
  const translations: Record<string, string> = {
    'pending': 'Pendiente',
    'completed': 'Completado',
    'failed': 'Fallido'
  };
  return translations[status] || status;
};

// Función para obtener color del estado
const getStatusColor = (status: string): string => {
  switch (status) {
    case 'completed':
      return 'bg-green-100 text-green-700 border-green-300';
    case 'pending':
      return 'bg-yellow-100 text-yellow-700 border-yellow-300';
    case 'failed':
      return 'bg-red-100 text-red-700 border-red-300';
    default:
      return 'bg-gray-100 text-gray-700 border-gray-300';
  }
};

export default function Orders() {
  const [orders, setOrders] = useState<Order[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const navigate = useNavigate();

  useEffect(() => {
    const token = localStorage.getItem('auth_token');
    if (!token) {
      navigate('/login');
      return;
    }
    loadOrders();
  }, [navigate]);

  const loadOrders = async () => {
    try {
      setLoading(true);
      const response = await ordersAPI.getAll();
      setOrders(response.data);
    } catch (err: any) {
      setError(err.response?.data?.error || 'Error al cargar los pedidos');
      console.error(err);
    } finally {
      setLoading(false);
    }
  };

  const formatDate = (dateString: string) => {
    const date = new Date(dateString);
    return date.toLocaleDateString('es-ES', {
      year: 'numeric',
      month: 'long',
      day: 'numeric',
      hour: '2-digit',
      minute: '2-digit'
    });
  };

  if (loading) {
    return (
      <div className="container mx-auto px-4 py-16 text-center">
        <div className="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mb-4"></div>
        <div className="text-xl text-gray-600">Cargando pedidos...</div>
      </div>
    );
  }

  if (error) {
    return (
      <div className="container mx-auto px-4 py-16">
        <div className="max-w-md mx-auto text-center bg-white rounded-lg shadow-lg p-8">
          <div className="text-6xl mb-4">❌</div>
          <h1 className="text-2xl font-bold text-red-600 mb-4">Error</h1>
          <p className="text-gray-600 mb-6">{error}</p>
          <button
            onClick={() => navigate('/')}
            className="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition"
          >
            Volver al Inicio
          </button>
        </div>
      </div>
    );
  }

  if (orders.length === 0) {
    return (
      <div className="container mx-auto px-4 py-16">
        <div className="max-w-md mx-auto text-center bg-white rounded-lg shadow-lg p-12">
          <div className="text-6xl mb-6">📦</div>
          <h1 className="text-3xl font-bold mb-4 text-gray-800">No hay pedidos</h1>
          <p className="text-gray-600 mb-8">Aún no has realizado ningún pedido</p>
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
      <h1 className="text-3xl font-bold mb-6 text-gray-800">Historial de Pedidos</h1>
      
      <div className="space-y-6">
        {orders.map((order) => (
          <div key={order.id} className="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
            {/* Header del pedido */}
            <div className="bg-gradient-to-r from-blue-50 to-blue-100 px-6 py-4 border-b border-gray-200">
              <div className="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                  <h2 className="text-xl font-bold text-gray-800">
                    Pedido #{order.id}
                  </h2>
                  <p className="text-sm text-gray-600 mt-1">
                    {formatDate(order.created_at)}
                  </p>
                </div>
                <div className="flex flex-col md:flex-row md:items-center gap-3">
                  <span className={`inline-block px-4 py-2 rounded-full text-sm font-semibold border ${getStatusColor(order.status)}`}>
                    {translateStatus(order.status)}
                  </span>
                  <div className="text-right">
                    <p className="text-sm text-gray-600">Total</p>
                    <p className="text-2xl font-bold text-blue-600">
                      {(order.total_cents / 100).toFixed(2)} €
                    </p>
                  </div>
                </div>
              </div>
            </div>

            {/* Items del pedido */}
            <div className="p-6">
              <h3 className="text-lg font-semibold mb-4 text-gray-800">Productos</h3>
              <div className="space-y-4">
                {order.items.map((item) => (
                  <div key={item.id} className="flex gap-4 p-4 bg-gray-50 rounded-lg border border-gray-100">
                    {item.product.image_url && (
                      <div className="w-20 h-20 flex-shrink-0 bg-white border border-gray-100 rounded-lg p-2 flex items-center justify-center relative">
                        <img
                          src={`${BASE_URL}${item.product.image_url}`}
                          alt={item.product.name}
                          className="max-w-full max-h-full object-contain"
                          onError={(e) => {
                            const target = e.target as HTMLImageElement;
                            target.style.display = 'none';
                            const placeholder = target.nextElementSibling as HTMLElement;
                            if (placeholder) placeholder.style.display = 'flex';
                          }}
                        />
                        <div className="hidden absolute inset-0 bg-gray-100 flex items-center justify-center text-gray-400 text-xl">
                          📦
                        </div>
                      </div>
                    )}
                    <div className="flex-grow">
                      <span className="inline-block px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs mb-2">
                        {translateCategory(item.product.category || '')}
                      </span>
                      <h4 className="font-semibold text-lg mb-1">{item.product.name}</h4>
                      <p className="text-gray-600 text-sm mb-2">{item.product.brand}</p>
                      <div className="flex items-center gap-4 text-sm text-gray-600">
                        <span>Cantidad: <strong>{item.quantity}</strong></span>
                        <span>Precio unitario: <strong>{(item.price_cents / 100).toFixed(2)} €</strong></span>
                      </div>
                    </div>
                    <div className="text-right">
                      <p className="text-xs text-gray-500 mb-1">Subtotal</p>
                      <p className="text-lg font-bold text-gray-800">
                        {((item.price_cents * item.quantity) / 100).toFixed(2)} €
                      </p>
                    </div>
                  </div>
                ))}
              </div>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}


