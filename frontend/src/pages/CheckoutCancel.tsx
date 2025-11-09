import { useNavigate } from 'react-router-dom';

export default function CheckoutCancel() {
  const navigate = useNavigate();

  return (
    <div className="container mx-auto px-4 py-8 text-center max-w-2xl">
      <div className="text-6xl mb-4">❌</div>
      <h1 className="text-3xl font-bold text-red-600 mb-4">Pago Cancelado</h1>
      <p className="text-gray-600 mb-8">
        Has cancelado el proceso de pago. Tu carrito sigue intacto y puedes continuar con tu
        compra cuando quieras.
      </p>
      <div className="space-x-4">
        <button
          onClick={() => navigate('/cart')}
          className="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600"
        >
          Volver al Carrito
        </button>
        <button
          onClick={() => navigate('/products')}
          className="bg-gray-500 text-white px-6 py-3 rounded hover:bg-gray-600"
        >
          Ver Productos
        </button>
      </div>
    </div>
  );
}



