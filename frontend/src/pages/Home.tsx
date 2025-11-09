import { Link } from 'react-router-dom';

export default function Home() {
  const categories = [
    { name: 'Procesadores', value: 'CPU', icon: '💻', description: 'Procesadores de última generación' },
    { name: 'Tarjetas Gráficas', value: 'GPU', icon: '🎮', description: 'GPUs potentes para gaming' },
    { name: 'Memoria RAM', value: 'RAM', icon: '⚡', description: 'Memoria de alto rendimiento' },
    { name: 'Almacenamiento', value: 'Storage', icon: '💾', description: 'Discos SSD y HDD rápidos' },
    { name: 'Placas Base', value: 'Motherboard', icon: '🔌', description: 'Placas base de calidad' },
    { name: 'Fuentes de Alimentación', value: 'PSU', icon: '🔋', description: 'PSU eficientes y certificadas' },
    { name: 'Torres', value: 'Case', icon: '📦', description: 'Cajas y torres de diseño' },
    { name: 'Refrigeración', value: 'Cooling', icon: '❄️', description: 'Refrigeración líquida y aire' },
    { name: 'Periféricos', value: 'Peripherals', icon: '🖱️', description: 'Teclados y ratones gaming' },
    { name: 'Monitores', value: 'Monitor', icon: '🖥️', description: 'Pantallas para gaming y trabajo' },
  ];

  const features = [
    {
      icon: '🚚',
      title: 'Envío Rápido',
      description: 'Recibe tus componentes en 24-48h'
    },
    {
      icon: '✅',
      title: 'Garantía Oficial',
      description: 'Todos los productos con garantía del fabricante'
    },
    {
      icon: '💳',
      title: 'Pago Seguro',
      description: 'Pagos procesados con Stripe de forma segura'
    },
    {
      icon: '🔧',
      title: 'Soporte Técnico',
      description: 'Asesoramiento experto para tu build'
    },
  ];

  return (
    <div className="min-h-screen">
      {/* Hero Section */}
      <section className="bg-gradient-to-br from-blue-600 via-blue-700 to-blue-900 text-white py-20">
        <div className="container mx-auto px-4">
          <div className="max-w-4xl mx-auto text-center">
            <h1 className="text-5xl md:text-6xl font-bold mb-6 animate-fade-in">
              Construye tu PC de ensueño
            </h1>
            <p className="text-xl md:text-2xl mb-8 text-blue-100">
              Componentes informáticos de calidad al mejor precio. 
              <br className="hidden md:block" />
              Todo lo que necesitas para tu setup perfecto.
            </p>
            <div className="flex flex-col sm:flex-row gap-4 justify-center">
              <Link
                to="/products"
                className="bg-white text-blue-600 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-blue-50 transition transform hover:scale-105 shadow-lg"
              >
                Ver Catálogo 🛒
              </Link>
              <Link
                to="/register"
                className="bg-blue-500 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-blue-400 transition border-2 border-blue-400 transform hover:scale-105"
              >
                Crear Cuenta 🚀
              </Link>
            </div>
          </div>
        </div>
      </section>

      {/* Categorías Destacadas */}
      <section className="py-16 bg-white">
        <div className="container mx-auto px-4">
          <h2 className="text-3xl md:text-4xl font-bold text-center mb-12 text-gray-800">
            Explora Nuestras Categorías
          </h2>
          <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
            {categories.map((category, index) => (
              <Link
                key={category.value}
                to={`/products?category=${category.value}`}
                className="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-200"
                style={{ animationDelay: `${index * 100}ms` }}
              >
                <div className="text-5xl mb-4">{category.icon}</div>
                <h3 className="text-xl font-bold mb-2 text-gray-800">{category.name}</h3>
                <p className="text-gray-600 text-sm">{category.description}</p>
              </Link>
            ))}
          </div>
        </div>
      </section>

      {/* Features Section */}
      <section className="py-16 bg-gray-50">
        <div className="container mx-auto px-4">
          <h2 className="text-3xl md:text-4xl font-bold text-center mb-12 text-gray-800">
            ¿Por qué CheapParts?
          </h2>
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            {features.map((feature, index) => (
              <div
                key={index}
                className="text-center bg-white rounded-lg p-6 shadow-sm hover:shadow-md transition"
              >
                <div className="text-5xl mb-4">{feature.icon}</div>
                <h3 className="text-lg font-bold mb-2 text-gray-800">{feature.title}</h3>
                <p className="text-gray-600 text-sm">{feature.description}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* CTA Section */}
      <section className="py-16 bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div className="container mx-auto px-4 text-center">
          <h2 className="text-3xl md:text-4xl font-bold mb-6">
            ¿Listo para empezar?
          </h2>
          <p className="text-xl mb-8 text-blue-100 max-w-2xl mx-auto">
            Únete a miles de usuarios satisfechos que han encontrado sus componentes perfectos en CheapParts
          </p>
          <Link
            to="/products"
            className="inline-block bg-white text-blue-600 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-blue-50 transition transform hover:scale-105 shadow-lg"
          >
            Explorar Productos Ahora →
          </Link>
        </div>
      </section>

      {/* Stats Section */}
      <section className="py-12 bg-white border-t border-gray-200">
        <div className="container mx-auto px-4">
          <div className="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
              <div className="text-4xl font-bold text-blue-600 mb-2">60+</div>
              <div className="text-gray-600">Productos</div>
            </div>
            <div>
              <div className="text-4xl font-bold text-blue-600 mb-2">10</div>
              <div className="text-gray-600">Categorías</div>
            </div>
            <div>
              <div className="text-4xl font-bold text-blue-600 mb-2">24h</div>
              <div className="text-gray-600">Envío Express</div>
            </div>
            <div>
              <div className="text-4xl font-bold text-blue-600 mb-2">⭐⭐⭐⭐⭐</div>
              <div className="text-gray-600">Valoraciones</div>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
}

