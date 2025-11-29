import { useEffect, useState } from 'react';
import { Link, useSearchParams } from 'react-router-dom';
import { productsAPI, getImageUrl } from '../lib/api';
import type { Product } from '../types';

interface PaginationMeta {
  current_page: number;
  last_page: number;
  per_page: number;
  total: number;
}

interface Filters {
  categories: string[];
  brands: string[];
  price_range: {
    min: number;
    max: number;
  };
}

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

export default function Products() {
  const [searchParams] = useSearchParams();
  const [products, setProducts] = useState<Product[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [pagination, setPagination] = useState<PaginationMeta | null>(null);
  const [currentPage, setCurrentPage] = useState(1);
  
  // Filtros disponibles
  const [availableFilters, setAvailableFilters] = useState<Filters | null>(null);
  
  // Filtros activos - INICIALIZAR CON LOS VALORES DE LA URL
  const [searchQuery, setSearchQuery] = useState(searchParams.get('q') || '');
  const [selectedCategory, setSelectedCategory] = useState(searchParams.get('category') || '');
  const [selectedBrand, setSelectedBrand] = useState(searchParams.get('brand') || '');
  const [minPrice, setMinPrice] = useState<number | undefined>();
  const [maxPrice, setMaxPrice] = useState<number | undefined>();
  const [inStockOnly, setInStockOnly] = useState(false);
  const [sortBy, setSortBy] = useState('');
  const [sortOrder, setSortOrder] = useState<'asc' | 'desc'>('asc');
  
  const [showFilters, setShowFilters] = useState(false);

  // Actualizar filtros cuando cambie la URL
  useEffect(() => {
    const categoryFromUrl = searchParams.get('category') || '';
    const brandFromUrl = searchParams.get('brand') || '';
    const searchFromUrl = searchParams.get('q') || '';
    
    setSelectedCategory(categoryFromUrl);
    setSelectedBrand(brandFromUrl);
    setSearchQuery(searchFromUrl);
  }, [searchParams]);

  useEffect(() => {
    loadFilters();
  }, []);

  useEffect(() => {
    loadProducts(currentPage);
  }, [currentPage, selectedCategory, selectedBrand, minPrice, maxPrice, inStockOnly, sortBy, sortOrder]);

  const loadFilters = async () => {
    try {
      const response = await productsAPI.getFilters();
      setAvailableFilters(response.data);
    } catch (err) {
      console.error('Error al cargar filtros:', err);
    }
  };

  const loadProducts = async (page: number) => {
    try {
      setLoading(true);
      const params: any = { page };
      
      if (searchQuery) params.q = searchQuery;
      if (selectedCategory) params.category = selectedCategory;
      if (selectedBrand) params.brand = selectedBrand;
      if (minPrice) params.min_price = minPrice;
      if (maxPrice) params.max_price = maxPrice;
      if (inStockOnly) params.in_stock = true;
      if (sortBy) {
        params.sort_by = sortBy;
        params.sort_order = sortOrder;
      }
      
      const response = await productsAPI.getAll(params);
      const productData = response.data.data || [];
      setProducts(Array.isArray(productData) ? productData : []);
      setPagination({
        current_page: response.data.current_page,
        last_page: response.data.last_page,
        per_page: response.data.per_page,
        total: response.data.total,
      });
    } catch (err: any) {
      const errorMessage = err?.response?.data?.message || err?.message || 'Error al cargar productos';
      setError(`Error al cargar productos: ${errorMessage}`);
      console.error('Error detallado:', {
        message: err?.message,
        response: err?.response?.data,
        status: err?.response?.status,
        url: err?.config?.url,
        baseURL: err?.config?.baseURL,
      });
    } finally {
      setLoading(false);
    }
  };

  const handleSearch = (e: React.FormEvent) => {
    e.preventDefault();
    setCurrentPage(1);
    loadProducts(1);
  };

  const clearFilters = () => {
    setSearchQuery('');
    setSelectedCategory('');
    setSelectedBrand('');
    setMinPrice(undefined);
    setMaxPrice(undefined);
    setInStockOnly(false);
    setSortBy('');
    setCurrentPage(1);
  };

  if (error) return <div className="text-red-500 text-center py-8">{error}</div>;

  return (
    <div className="container mx-auto px-3 sm:px-4 py-4 sm:py-6 lg:py-8">
      {/* Header con búsqueda */}
      <div className="mb-4 sm:mb-6">
        <h1 className="text-2xl sm:text-3xl font-bold mb-3 sm:mb-4">Catálogo de Productos</h1>
        <form onSubmit={handleSearch} className="flex gap-2">
          <input
            type="text"
            value={searchQuery}
            onChange={(e) => setSearchQuery(e.target.value)}
            placeholder="Buscar productos..."
            className="flex-1 px-3 sm:px-4 py-2 text-sm sm:text-base bg-white border-2 border-gray-300 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
          />
          <button
            type="submit"
            className="px-4 sm:px-6 py-2 text-sm sm:text-base bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition whitespace-nowrap"
          >
            Buscar
          </button>
        </form>
      </div>

      <div className="flex gap-4 lg:gap-6">
        {/* Sidebar de filtros - Desktop */}
        <div className={`hidden lg:block w-64 flex-shrink-0`}>
          <div className="bg-gradient-to-br from-gray-50 to-white rounded-lg shadow-md border border-gray-200 p-5 sticky top-4">
            <div className="flex justify-between items-center mb-6">
              <h2 className="text-lg font-bold text-gray-800">Filtros</h2>
              <button
                onClick={clearFilters}
                className="text-sm font-medium text-blue-600 hover:text-blue-800 hover:underline transition"
              >
                Limpiar
              </button>
            </div>

            {/* Categorías */}
            {availableFilters && availableFilters.categories.length > 0 && (
              <div className="mb-6">
                <h3 className="font-semibold mb-2 text-sm text-gray-800">Categoría</h3>
                <select
                  value={selectedCategory}
                  onChange={(e) => {
                    setSelectedCategory(e.target.value);
                    setCurrentPage(1);
                  }}
                  className="w-full px-3 py-2 bg-white border-2 border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm"
                >
                  <option value="">Todas</option>
                  {availableFilters.categories.map((cat) => (
                    <option key={cat} value={cat}>
                      {translateCategory(cat)}
                    </option>
                  ))}
                </select>
              </div>
            )}

            {/* Marcas */}
            {availableFilters && availableFilters.brands.length > 0 && (
              <div className="mb-6">
                <h3 className="font-semibold mb-2 text-sm text-gray-800">Marca</h3>
                <select
                  value={selectedBrand}
                  onChange={(e) => {
                    setSelectedBrand(e.target.value);
                    setCurrentPage(1);
                  }}
                  className="w-full px-3 py-2 bg-white border-2 border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm"
                >
                  <option value="">Todas</option>
                  {availableFilters.brands.map((brand) => (
                    <option key={brand} value={brand}>
                      {brand}
                    </option>
                  ))}
                </select>
              </div>
            )}

            {/* Rango de precio */}
            <div className="mb-6">
              <h3 className="font-semibold mb-2 text-sm text-gray-800">Precio (€)</h3>
              <div className="flex gap-2 items-center">
                <input
                  type="number"
                  placeholder="Mín"
                  value={minPrice ? minPrice / 100 : ''}
                  onChange={(e) => {
                    const value = e.target.value ? parseFloat(e.target.value) * 100 : undefined;
                    setMinPrice(value);
                    setCurrentPage(1);
                  }}
                  className="w-full px-3 py-2 bg-white border-2 border-gray-300 rounded-lg text-gray-900 placeholder-gray-400 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                />
                <span className="text-gray-500">-</span>
                <input
                  type="number"
                  placeholder="Máx"
                  value={maxPrice ? maxPrice / 100 : ''}
                  onChange={(e) => {
                    const value = e.target.value ? parseFloat(e.target.value) * 100 : undefined;
                    setMaxPrice(value);
                    setCurrentPage(1);
                  }}
                  className="w-full px-3 py-2 bg-white border-2 border-gray-300 rounded-lg text-gray-900 placeholder-gray-400 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                />
              </div>
            </div>

            {/* Stock */}
            <div className="mb-6">
              <label className="flex items-center gap-2 cursor-pointer">
                <input
                  type="checkbox"
                  checked={inStockOnly}
                  onChange={(e) => {
                    setInStockOnly(e.target.checked);
                    setCurrentPage(1);
                  }}
                  className="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                />
                <span className="text-sm text-gray-700">Solo con stock</span>
              </label>
            </div>

            {/* Ordenar */}
            <div className="mb-4">
              <h3 className="font-semibold mb-2 text-sm text-gray-800">Ordenar por</h3>
              <select
                value={sortBy}
                onChange={(e) => {
                  setSortBy(e.target.value);
                  setCurrentPage(1);
                }}
                className="w-full px-3 py-2 bg-white border-2 border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm mb-2"
              >
                <option value="">Por defecto</option>
                <option value="price">Precio</option>
                <option value="name">Nombre</option>
                <option value="stock">Stock</option>
              </select>
              {sortBy && (
                <div className="flex gap-2">
                  <button
                    onClick={() => {
                      setSortOrder('asc');
                      setCurrentPage(1);
                    }}
                    className={`flex-1 px-3 py-1 text-xs rounded ${
                      sortOrder === 'asc'
                        ? 'bg-blue-600 text-white'
                        : 'bg-gray-200 text-gray-700'
                    }`}
                  >
                    Ascendente
                  </button>
                  <button
                    onClick={() => {
                      setSortOrder('desc');
                      setCurrentPage(1);
                    }}
                    className={`flex-1 px-3 py-1 text-xs rounded ${
                      sortOrder === 'desc'
                        ? 'bg-blue-600 text-white'
                        : 'bg-gray-200 text-gray-700'
                    }`}
                  >
                    Descendente
                  </button>
                </div>
              )}
            </div>
          </div>
        </div>

        {/* Grid de productos */}
        <div className="flex-1 min-w-0">
          {/* Contador de resultados - Desktop */}
          {pagination && (
            <div className="hidden lg:block mb-4 text-sm text-gray-600">
              Mostrando {products.length} de {pagination.total} productos
            </div>
          )}
          {/* Toggle filtros en móvil */}
          <div className="lg:hidden mb-4 flex items-center justify-between gap-2">
            <button
              onClick={() => setShowFilters(!showFilters)}
              className="flex-1 px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium text-sm sm:text-base flex items-center justify-center gap-2"
            >
              <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
              </svg>
              {showFilters ? 'Ocultar' : 'Mostrar'} Filtros
            </button>
            {pagination && (
              <div className="text-xs sm:text-sm text-gray-600 whitespace-nowrap">
                {pagination.total} productos
              </div>
            )}
          </div>

          {/* Filtros móvil - Drawer */}
          {showFilters && (
            <div className="lg:hidden fixed inset-0 z-50 lg:relative lg:inset-auto">
              {/* Overlay */}
              <div 
                className="fixed inset-0 bg-black bg-opacity-50 lg:hidden"
                onClick={() => setShowFilters(false)}
              />
              {/* Drawer */}
              <div className="fixed right-0 top-0 h-full w-80 max-w-[85vw] bg-white shadow-xl overflow-y-auto lg:relative lg:w-64 lg:shadow-md lg:rounded-lg lg:border lg:border-gray-200 lg:sticky lg:top-4 lg:h-auto">
                <div className="p-4 sm:p-5">
                  <div className="flex justify-between items-center mb-4 lg:mb-6">
                    <h2 className="text-lg font-bold text-gray-800">Filtros</h2>
                    <div className="flex items-center gap-3">
                      <button
                        onClick={clearFilters}
                        className="text-sm font-medium text-blue-600 hover:text-blue-800 hover:underline transition"
                      >
                        Limpiar
                      </button>
                      <button
                        onClick={() => setShowFilters(false)}
                        className="lg:hidden p-1 hover:bg-gray-100 rounded"
                      >
                        <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
                        </svg>
                      </button>
                    </div>
                  </div>

                  {/* Categorías */}
                  {availableFilters && availableFilters.categories.length > 0 && (
                    <div className="mb-6">
                      <h3 className="font-semibold mb-2 text-sm text-gray-800">Categoría</h3>
                      <select
                        value={selectedCategory}
                        onChange={(e) => {
                          setSelectedCategory(e.target.value);
                          setCurrentPage(1);
                        }}
                        className="w-full px-3 py-2 bg-white border-2 border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm"
                      >
                        <option value="">Todas</option>
                        {availableFilters.categories.map((cat) => (
                          <option key={cat} value={cat}>
                            {translateCategory(cat)}
                          </option>
                        ))}
                      </select>
                    </div>
                  )}

                  {/* Marcas */}
                  {availableFilters && availableFilters.brands.length > 0 && (
                    <div className="mb-6">
                      <h3 className="font-semibold mb-2 text-sm text-gray-800">Marca</h3>
                      <select
                        value={selectedBrand}
                        onChange={(e) => {
                          setSelectedBrand(e.target.value);
                          setCurrentPage(1);
                        }}
                        className="w-full px-3 py-2 bg-white border-2 border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm"
                      >
                        <option value="">Todas</option>
                        {availableFilters.brands.map((brand) => (
                          <option key={brand} value={brand}>
                            {brand}
                          </option>
                        ))}
                      </select>
                    </div>
                  )}

                  {/* Rango de precio */}
                  <div className="mb-6">
                    <h3 className="font-semibold mb-2 text-sm text-gray-800">Precio (€)</h3>
                    <div className="flex gap-2 items-center">
                      <input
                        type="number"
                        placeholder="Mín"
                        value={minPrice ? minPrice / 100 : ''}
                        onChange={(e) => {
                          const value = e.target.value ? parseFloat(e.target.value) * 100 : undefined;
                          setMinPrice(value);
                          setCurrentPage(1);
                        }}
                        className="w-full px-3 py-2 bg-white border-2 border-gray-300 rounded-lg text-gray-900 placeholder-gray-400 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                      />
                      <span className="text-gray-500">-</span>
                      <input
                        type="number"
                        placeholder="Máx"
                        value={maxPrice ? maxPrice / 100 : ''}
                        onChange={(e) => {
                          const value = e.target.value ? parseFloat(e.target.value) * 100 : undefined;
                          setMaxPrice(value);
                          setCurrentPage(1);
                        }}
                        className="w-full px-3 py-2 bg-white border-2 border-gray-300 rounded-lg text-gray-900 placeholder-gray-400 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                      />
                    </div>
                  </div>

                  {/* Stock */}
                  <div className="mb-6">
                    <label className="flex items-center gap-2 cursor-pointer">
                      <input
                        type="checkbox"
                        checked={inStockOnly}
                        onChange={(e) => {
                          setInStockOnly(e.target.checked);
                          setCurrentPage(1);
                        }}
                        className="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                      />
                      <span className="text-sm text-gray-700">Solo con stock</span>
                    </label>
                  </div>

                  {/* Ordenar */}
                  <div className="mb-4">
                    <h3 className="font-semibold mb-2 text-sm text-gray-800">Ordenar por</h3>
                    <select
                      value={sortBy}
                      onChange={(e) => {
                        setSortBy(e.target.value);
                        setCurrentPage(1);
                      }}
                      className="w-full px-3 py-2 bg-white border-2 border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm mb-2"
                    >
                      <option value="">Por defecto</option>
                      <option value="price">Precio</option>
                      <option value="name">Nombre</option>
                      <option value="stock">Stock</option>
                    </select>
                    {sortBy && (
                      <div className="flex gap-2">
                        <button
                          onClick={() => {
                            setSortOrder('asc');
                            setCurrentPage(1);
                          }}
                          className={`flex-1 px-3 py-1 text-xs rounded ${
                            sortOrder === 'asc'
                              ? 'bg-blue-600 text-white'
                              : 'bg-gray-200 text-gray-700'
                          }`}
                        >
                          Ascendente
                        </button>
                        <button
                          onClick={() => {
                            setSortOrder('desc');
                            setCurrentPage(1);
                          }}
                          className={`flex-1 px-3 py-1 text-xs rounded ${
                            sortOrder === 'desc'
                              ? 'bg-blue-600 text-white'
                              : 'bg-gray-200 text-gray-700'
                          }`}
                        >
                          Descendente
                        </button>
                      </div>
                    )}
                  </div>
                </div>
              </div>
            </div>
          )}

          {loading ? (
            <div className="text-center py-12">
              <div className="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
              <p className="mt-2 text-gray-600">Cargando productos...</p>
            </div>
          ) : products.length === 0 ? (
            <div className="text-center py-12 bg-gray-50 rounded-lg">
              <p className="text-gray-600 text-lg">No se encontraron productos</p>
              <button
                onClick={clearFilters}
                className="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition"
              >
                Limpiar filtros
              </button>
            </div>
          ) : (
            <>
              <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5 lg:gap-6">
                {products.map((product) => (
                  <Link
                    key={product.id}
                    to={`/products/${product.id}`}
                    className="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group"
                  >
                    {product.image_url && (
                      <div className="relative h-48 sm:h-56 lg:h-64 overflow-hidden bg-white flex items-center justify-center p-3 sm:p-4">
                        <img
                          src={getImageUrl(product.image_url)}
                          alt={product.name}
                          className="max-w-full max-h-full object-contain group-hover:scale-105 transition-transform duration-300"
                          onError={(e) => {
                            const target = e.target as HTMLImageElement;
                            target.style.display = 'none';
                            const placeholder = target.nextElementSibling as HTMLElement;
                            if (placeholder) placeholder.style.display = 'flex';
                          }}
                        />
                        <div className="hidden absolute inset-0 bg-gray-100 flex items-center justify-center text-gray-400">
                          <div className="text-center">
                            <div className="text-4xl mb-2">📦</div>
                            <div className="text-sm">Sin imagen</div>
                          </div>
                        </div>
                        {product.stock === 0 && (
                          <div className="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                            <span className="text-white font-bold text-lg">Sin Stock</span>
                          </div>
                        )}
                      </div>
                    )}
                    <div className="p-3 sm:p-4">
                      <div className="flex justify-between items-start mb-2 gap-2">
                        <span className="text-xs px-2 py-1 bg-blue-100 text-blue-700 rounded flex-shrink-0">
                          {translateCategory(product.category)}
                        </span>
                        <span className="text-xs text-gray-500 truncate ml-auto">{product.brand}</span>
                      </div>
                      <h3 className="font-semibold text-sm sm:text-base mb-2 line-clamp-2 group-hover:text-blue-600 transition min-h-[2.5rem] sm:min-h-[3rem]">
                        {product.name}
                      </h3>
                      <div className="flex justify-between items-end gap-2">
                        <p className="text-blue-600 font-bold text-lg sm:text-xl">
                          {(product.price_cents / 100).toFixed(2)} €
                        </p>
                        {product.stock > 0 ? (
                          <span className="px-2 py-1 bg-green-100 text-green-700 rounded text-xs font-medium">
                            Disponible
                          </span>
                        ) : (
                          <span className="px-2 py-1 bg-red-100 text-red-700 rounded text-xs font-medium">
                            Sin stock
                          </span>
                        )}
                      </div>
                    </div>
                  </Link>
                ))}
              </div>

              {/* Paginación */}
              {pagination && pagination.last_page > 1 && (
                <div className="flex justify-center items-center gap-1 sm:gap-2 mt-6 sm:mt-8 flex-wrap">
                  <button
                    onClick={() => setCurrentPage(p => Math.max(1, p - 1))}
                    disabled={currentPage === 1}
                    className="px-3 sm:px-4 py-2 text-sm sm:text-base bg-blue-600 text-white rounded-lg hover:bg-blue-700 disabled:bg-gray-300 disabled:cursor-not-allowed transition"
                  >
                    ← Anterior
                  </button>
                  
                  <div className="flex gap-1">
                    {Array.from({ length: Math.min(5, pagination.last_page) }, (_, i) => {
                      let pageNum;
                      if (pagination.last_page <= 5) {
                        pageNum = i + 1;
                      } else if (currentPage <= 3) {
                        pageNum = i + 1;
                      } else if (currentPage >= pagination.last_page - 2) {
                        pageNum = pagination.last_page - 4 + i;
                      } else {
                        pageNum = currentPage - 2 + i;
                      }
                      
                      return (
                        <button
                          key={pageNum}
                          onClick={() => setCurrentPage(pageNum)}
                          className={`px-2 sm:px-3 py-2 text-sm sm:text-base rounded-lg transition ${
                            currentPage === pageNum
                              ? 'bg-blue-600 text-white'
                              : 'bg-gray-200 text-gray-700 hover:bg-gray-300'
                          }`}
                        >
                          {pageNum}
                        </button>
                      );
                    })}
                  </div>
                  
                  <button
                    onClick={() => setCurrentPage(p => Math.min(pagination.last_page, p + 1))}
                    disabled={currentPage === pagination.last_page}
                    className="px-3 sm:px-4 py-2 text-sm sm:text-base bg-blue-600 text-white rounded-lg hover:bg-blue-700 disabled:bg-gray-300 disabled:cursor-not-allowed transition"
                  >
                    Siguiente →
                  </button>
                </div>
              )}
            </>
          )}
        </div>
      </div>
    </div>
  );
}

