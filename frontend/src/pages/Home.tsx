import { Link } from 'react-router-dom';

export default function Home() {
  return (
    <div className="container mx-auto px-4 py-8">
      <h1 className="text-4xl font-bold mb-4">Bienvenido a CheapParts</h1>
      <p className="text-lg mb-6">
        Tu tienda online de componentes informáticos al mejor precio.
      </p>
      <Link
        to="/products"
        className="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600"
      >
        Ver Productos
      </Link>
    </div>
  );
}

