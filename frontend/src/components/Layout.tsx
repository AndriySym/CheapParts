import { Link, Outlet, useLocation } from 'react-router-dom';
import { useState, useEffect } from 'react';
import { cartAPI } from '../lib/api';

export default function Layout() {
  const token = localStorage.getItem('auth_token');
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
  const [cartItemCount, setCartItemCount] = useState(0);
  const location = useLocation();

  useEffect(() => {
    if (token) {
      loadCartCount();
    }
  }, [token, location]);

  const loadCartCount = async () => {
    try {
      const response = await cartAPI.getItems();
      setCartItemCount(response.data.length);
    } catch (err) {
      console.error('Error loading cart count:', err);
    }
  };

  const handleLogout = () => {
    localStorage.removeItem('auth_token');
    window.location.href = '/';
  };

  return (
    <div className="min-h-screen flex flex-col bg-gray-50">
      {/* Header moderno */}
      <header className="bg-gradient-to-r from-blue-600 to-blue-800 text-white shadow-lg sticky top-0 z-50">
        <nav className="container mx-auto px-4">
          <div className="flex justify-between items-center py-4">
            {/* Logo */}
            <Link 
              to="/" 
              className="text-2xl font-bold flex items-center gap-2 hover:opacity-90 transition"
            >
              <svg className="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
              </svg>
              CheapParts
            </Link>

            {/* Desktop Navigation */}
            <div className="hidden md:flex items-center space-x-6">
              <Link 
                to="/products" 
                className="hover:text-blue-200 transition font-medium"
              >
                🛒 Productos
              </Link>
              {token ? (
                <>
                  <Link 
                    to="/cart" 
                    className="relative hover:text-blue-200 transition font-medium flex items-center gap-1"
                  >
                    🛍️ Carrito
                    {cartItemCount > 0 && (
                      <span className="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">
                        {cartItemCount}
                      </span>
                    )}
                  </Link>
                  <button 
                    onClick={handleLogout} 
                    className="bg-white text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-50 transition"
                  >
                    Cerrar Sesión
                  </button>
                </>
              ) : (
                <>
                  <Link 
                    to="/login" 
                    className="hover:text-blue-200 transition font-medium"
                  >
                    Iniciar Sesión
                  </Link>
                  <Link 
                    to="/register" 
                    className="bg-white text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-50 transition"
                  >
                    Registrarse
                  </Link>
                </>
              )}
            </div>

            {/* Mobile Menu Button */}
            <button
              onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
              className="md:hidden p-2 rounded-lg hover:bg-blue-700 transition"
            >
              {mobileMenuOpen ? (
                <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
                </svg>
              ) : (
                <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 6h16M4 12h16M4 18h16" />
                </svg>
              )}
            </button>
          </div>

          {/* Mobile Menu */}
          {mobileMenuOpen && (
            <div className="md:hidden pb-4 space-y-2 animate-fade-in">
              <Link 
                to="/products" 
                onClick={() => setMobileMenuOpen(false)}
                className="block py-2 px-4 rounded hover:bg-blue-700 transition"
              >
                🛒 Productos
              </Link>
              {token ? (
                <>
                  <Link 
                    to="/cart" 
                    onClick={() => setMobileMenuOpen(false)}
                    className="block py-2 px-4 rounded hover:bg-blue-700 transition flex justify-between items-center"
                  >
                    <span>🛍️ Carrito</span>
                    {cartItemCount > 0 && (
                      <span className="bg-red-500 text-white text-xs rounded-full px-2 py-1 font-bold">
                        {cartItemCount}
                      </span>
                    )}
                  </Link>
                  <button 
                    onClick={() => {
                      handleLogout();
                      setMobileMenuOpen(false);
                    }}
                    className="block w-full text-left py-2 px-4 rounded hover:bg-blue-700 transition"
                  >
                    Cerrar Sesión
                  </button>
                </>
              ) : (
                <>
                  <Link 
                    to="/login" 
                    onClick={() => setMobileMenuOpen(false)}
                    className="block py-2 px-4 rounded hover:bg-blue-700 transition"
                  >
                    Iniciar Sesión
                  </Link>
                  <Link 
                    to="/register" 
                    onClick={() => setMobileMenuOpen(false)}
                    className="block py-2 px-4 rounded hover:bg-blue-700 transition"
                  >
                    Registrarse
                  </Link>
                </>
              )}
            </div>
          )}
        </nav>
      </header>

      {/* Main Content */}
      <main className="flex-grow">
        <Outlet />
      </main>

      {/* Footer mejorado */}
      <footer className="bg-gray-900 text-white">
        <div className="container mx-auto px-4 py-8">
          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
              <h3 className="text-xl font-bold mb-4">CheapParts</h3>
              <p className="text-gray-400 text-sm">
                Tu tienda de confianza para componentes informáticos de calidad al mejor precio.
              </p>
            </div>
            <div>
              <h4 className="font-semibold mb-4">Enlaces rápidos</h4>
              <ul className="space-y-2 text-sm text-gray-400">
                <li><Link to="/products" className="hover:text-white transition">Productos</Link></li>
                <li><Link to="/cart" className="hover:text-white transition">Carrito</Link></li>
                {!token && (
                  <>
                    <li><Link to="/login" className="hover:text-white transition">Iniciar Sesión</Link></li>
                    <li><Link to="/register" className="hover:text-white transition">Registrarse</Link></li>
                  </>
                )}
              </ul>
            </div>
            <div>
              <h4 className="font-semibold mb-4">Información</h4>
              <p className="text-gray-400 text-sm">
                Proyecto Integrado<br />
                Desarrollo de Aplicaciones Web<br />
                Andriy Symonenko Oliynyk
              </p>
            </div>
          </div>
          <div className="border-t border-gray-800 mt-8 pt-6 text-center text-gray-400 text-sm">
            <p>&copy; 2025 CheapParts. Todos los derechos reservados.</p>
          </div>
        </div>
      </footer>
    </div>
  );
}

