import { Link, Outlet } from 'react-router-dom';

export default function Layout() {
  const token = localStorage.getItem('auth_token');

  const handleLogout = () => {
    localStorage.removeItem('auth_token');
    window.location.href = '/';
  };

  return (
    <div className="min-h-screen flex flex-col">
      <header className="bg-blue-600 text-white shadow">
        <nav className="container mx-auto px-4 py-4 flex justify-between items-center">
          <Link to="/" className="text-2xl font-bold">
            CheapParts
          </Link>
          <div className="space-x-4">
            <Link to="/products" className="hover:underline">
              Productos
            </Link>
            {token ? (
              <>
                <Link to="/cart" className="hover:underline">
                  Carrito
                </Link>
                <button onClick={handleLogout} className="hover:underline">
                  Cerrar Sesión
                </button>
              </>
            ) : (
              <>
                <Link to="/login" className="hover:underline">
                  Iniciar Sesión
                </Link>
                <Link to="/register" className="hover:underline">
                  Registrarse
                </Link>
              </>
            )}
          </div>
        </nav>
      </header>
      <main className="flex-grow">
        <Outlet />
      </main>
      <footer className="bg-gray-800 text-white text-center py-4">
        <p>&copy; 2025 CheapParts - Andriy Symonenko Oliynyk</p>
      </footer>
    </div>
  );
}

