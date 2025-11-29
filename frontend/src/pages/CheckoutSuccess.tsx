import { useEffect, useState } from 'react';
import { useNavigate, useSearchParams } from 'react-router-dom';
import { paymentAPI } from '../lib/api';

interface SessionInfo {
  id: string;
  payment_status: string;
  customer_email: string;
  amount_total: number;
}

export default function CheckoutSuccess() {
  const [searchParams] = useSearchParams();
  const navigate = useNavigate();
  const [session, setSession] = useState<SessionInfo | null>(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');

  useEffect(() => {
    const sessionId = searchParams.get('session_id');
    if (!sessionId) {
      setError('No se encontró la sesión de pago');
      setLoading(false);
      return;
    }

    const fetchSession = async () => {
      try {
        const response = await paymentAPI.getCheckoutSuccess(sessionId);
        setSession(response.data.session);
        
        // El backend ya limpia el carrito automáticamente al crear el pedido
        // Solo emitimos el evento para actualizar el contador del carrito
        if (response.data.session.payment_status === 'paid') {
          window.dispatchEvent(new CustomEvent('cartUpdated'));
        }
        
      } catch (err: any) {
        setError(err.response?.data?.error || 'Error al obtener la información del pago');
      } finally {
        setLoading(false);
      }
    };

    fetchSession();
  }, [searchParams]);

  if (loading) {
    return (
      <div className="container mx-auto px-4 py-16 text-center">
        <div className="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mb-4"></div>
        <div className="text-xl text-gray-600">Verificando tu pago...</div>
      </div>
    );
  }

  if (error || !session) {
    return (
      <div className="container mx-auto px-4 py-16">
        <div className="max-w-md mx-auto text-center bg-white rounded-lg shadow-lg p-8">
          <div className="text-6xl mb-4">❌</div>
          <h1 className="text-2xl font-bold text-red-600 mb-4">Error al procesar el pedido</h1>
          <p className="text-gray-600 mb-6">{error || 'No se pudo verificar tu pago'}</p>
          <button
            onClick={() => navigate('/cart')}
            className="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition"
          >
            Volver al Carrito
          </button>
        </div>
      </div>
    );
  }

  return (
    <div className="container mx-auto px-4 py-16 max-w-3xl">
      <div className="bg-white rounded-lg shadow-lg overflow-hidden">
        {/* Header de éxito */}
        <div className="bg-gradient-to-r from-green-500 to-green-600 text-white text-center py-12 px-6">
          <div className="text-7xl mb-4">✅</div>
          <h1 className="text-4xl font-bold mb-2">¡Pago Realizado con Éxito!</h1>
          <p className="text-green-100 text-lg">Tu pedido ha sido procesado correctamente</p>
        </div>

        {/* Detalles del pago */}
        <div className="p-8">
          <div className="bg-gray-50 rounded-lg p-6 mb-6">
            <h2 className="text-xl font-bold mb-4 text-gray-800">Detalles del Pago</h2>
            <div className="space-y-3">
              <div className="flex justify-between items-center py-2 border-b border-gray-200">
                <span className="text-gray-600 font-medium">Estado del Pago:</span>
                <span className="flex items-center gap-2">
                  <span className="w-2 h-2 bg-green-500 rounded-full"></span>
                  <span className="font-semibold text-green-600">
                    {session.payment_status === 'paid' ? 'Pagado' : session.payment_status}
                  </span>
                </span>
              </div>
              <div className="flex justify-between items-center py-2 border-b border-gray-200">
                <span className="text-gray-600 font-medium">Email de Confirmación:</span>
                <span className="font-semibold text-gray-800">{session.customer_email}</span>
              </div>
              <div className="flex justify-between items-center py-2 border-b border-gray-200">
                <span className="text-gray-600 font-medium">ID de Transacción:</span>
                <span className="font-mono text-sm text-gray-600">{session.id}</span>
              </div>
              <div className="flex justify-between items-center py-3 mt-4">
                <span className="text-gray-800 font-bold text-lg">Total Pagado:</span>
                <span className="font-bold text-2xl text-green-600">
                  {(session.amount_total / 100).toFixed(2)} €
                </span>
              </div>
            </div>
          </div>

          {/* Información adicional */}
          <div className="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
            <div className="flex items-start gap-3">
              <div className="text-2xl">📧</div>
              <div>
                <h3 className="font-semibold text-blue-900 mb-1">Confirmación Enviada</h3>
                <p className="text-sm text-blue-800">
                  Hemos enviado un correo electrónico de confirmación a <strong>{session.customer_email}</strong> con todos los detalles de tu compra.
                </p>
              </div>
            </div>
          </div>

          {/* Botones de acción */}
          <div className="flex flex-col sm:flex-row gap-4 justify-center pt-4">
            <button
              onClick={() => navigate('/orders')}
              className="flex-1 bg-green-600 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-green-700 transition transform hover:scale-105 flex items-center justify-center gap-2"
            >
              <span>📦</span>
              <span>Ver Mis Pedidos</span>
            </button>
            <button
              onClick={() => navigate('/products')}
              className="flex-1 bg-blue-600 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-blue-700 transition transform hover:scale-105 flex items-center justify-center gap-2"
            >
              <span>🛍️</span>
              <span>Continuar Comprando</span>
            </button>
            <button
              onClick={() => navigate('/')}
              className="flex-1 bg-gray-600 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-gray-700 transition transform hover:scale-105 flex items-center justify-center gap-2"
            >
              <span>🏠</span>
              <span>Ir al Inicio</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  );
}
