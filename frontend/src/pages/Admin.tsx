import { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { productsAPI, authAPI } from '../lib/api';
import type { Product } from '../types';
// @ts-ignore - sweetalert2 types are included in the package
import Swal from 'sweetalert2';

export default function Admin() {
  const navigate = useNavigate();
  const [products, setProducts] = useState<Product[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [showForm, setShowForm] = useState(false);
  const [editingProduct, setEditingProduct] = useState<Product | null>(null);
  const [isAdmin, setIsAdmin] = useState(false);
  const [isDragging, setIsDragging] = useState(false);
  const [uploadingImage, setUploadingImage] = useState(false);

  const [formData, setFormData] = useState({
    name: '',
    description: '',
    stock: 0,
    brand: '',
    category: '',
    image_url: '',
    price_cents: 0,
  });

  const categories = [
    'CPU', 'GPU', 'RAM', 'Storage', 'Motherboard', 
    'PSU', 'Case', 'Cooling', 'Peripherals', 'Monitor'
  ];

  useEffect(() => {
    checkAdmin();
    loadProducts();
  }, []);

  const checkAdmin = async () => {
    try {
      const response = await authAPI.me();
      if (response.data.is_admin) {
        setIsAdmin(true);
      } else {
        navigate('/');
      }
    } catch (err) {
      navigate('/login');
    }
  };

  const loadProducts = async () => {
    try {
      setLoading(true);
      // Cargar todos los productos (usando un número alto de items por página)
      let allProducts: Product[] = [];
      let currentPage = 1;
      let hasMore = true;

      while (hasMore) {
        const response = await productsAPI.getAll({ page: currentPage });
        const pageData = response.data.data || [];
        allProducts = [...allProducts, ...pageData];
        
        hasMore = currentPage < (response.data.last_page || 1);
        currentPage++;
        
        // Limitar a 10 páginas para evitar bucles infinitos
        if (currentPage > 10) break;
      }

      setProducts(allProducts);
    } catch (err: any) {
      setError(err.response?.data?.message || 'Error al cargar productos');
    } finally {
      setLoading(false);
    }
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setError('');

    try {
      if (editingProduct) {
        await (productsAPI as any).update(editingProduct.id, formData);
        await Swal.fire({
          icon: 'success',
          title: '¡Producto actualizado!',
          text: 'El producto se ha actualizado correctamente.',
          timer: 2000,
          showConfirmButton: false,
        });
      } else {
        await (productsAPI as any).create(formData);
        await Swal.fire({
          icon: 'success',
          title: '¡Producto creado!',
          text: 'El producto se ha creado correctamente.',
          timer: 2000,
          showConfirmButton: false,
        });
      }
      
      setShowForm(false);
      setEditingProduct(null);
      resetForm();
      loadProducts();
    } catch (err: any) {
      await Swal.fire({
        icon: 'error',
        title: 'Error',
        text: err.response?.data?.message || 'Error al guardar el producto',
      });
    }
  };

  const handleEdit = (product: Product) => {
    setEditingProduct(product);
    setFormData({
      name: product.name,
      description: product.description || '',
      stock: product.stock,
      brand: product.brand || '',
      category: product.category || '',
      image_url: product.image_url || '',
      price_cents: product.price_cents,
    });
    setShowForm(true);
  };

  const handleDelete = async (id: number) => {
    const result = await Swal.fire({
      title: '¿Estás seguro?',
      text: 'No podrás revertir esta acción',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Sí, eliminar',
      cancelButtonText: 'Cancelar',
    });

    if (!result.isConfirmed) {
      return;
    }

    try {
      await (productsAPI as any).delete(id);
      await Swal.fire({
        icon: 'success',
        title: '¡Producto eliminado!',
        text: 'El producto se ha eliminado correctamente.',
        timer: 2000,
        showConfirmButton: false,
      });
      loadProducts();
    } catch (err: any) {
      await Swal.fire({
        icon: 'error',
        title: 'Error',
        text: err.response?.data?.message || 'Error al eliminar el producto',
      });
    }
  };

  const resetForm = () => {
    setFormData({
      name: '',
      description: '',
      stock: 0,
      brand: '',
      category: '',
      image_url: '',
      price_cents: 0,
    });
    setEditingProduct(null);
  };

  const handleImageUpload = async (file: File) => {
    try {
      setUploadingImage(true);
      setError('');
      const response = await (productsAPI as any).uploadImage(file);
      setFormData({ ...formData, image_url: response.data.url });
    } catch (err: any) {
      await Swal.fire({
        icon: 'error',
        title: 'Error',
        text: err.response?.data?.message || 'Error al subir la imagen',
      });
    } finally {
      setUploadingImage(false);
    }
  };

  if (!isAdmin) {
    return null;
  }

  return (
    <div className="container mx-auto px-4 py-8">
      <div className="mb-8">
        <h1 className="text-4xl font-bold text-gray-800 mb-2">Panel de Administración</h1>
        <p className="text-gray-600">Gestiona los productos de la tienda</p>
      </div>

      {error && (
        <div className="bg-red-50 border-2 border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
          ⚠️ {error}
        </div>
      )}

      <div className="mb-6">
        <button
          onClick={() => {
            resetForm();
            setShowForm(!showForm);
          }}
          className="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition flex items-center gap-2"
        >
          {showForm ? (
            <>
              <span className="text-white">❌</span>
              <span>Cancelar</span>
            </>
          ) : (
            <>
              <span className="text-white text-lg font-bold leading-none">+</span>
              <span>Nuevo Producto</span>
            </>
          )}
        </button>
      </div>

      {showForm && (
        <div className="bg-white rounded-lg shadow-lg p-6 mb-8">
          <h2 className="text-2xl font-bold mb-4 text-gray-800">
            {editingProduct ? 'Editar Producto' : 'Nuevo Producto'}
          </h2>
          <form onSubmit={handleSubmit} className="space-y-4">
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label className="block mb-2 font-semibold text-gray-700">Nombre *</label>
                <input
                  type="text"
                  value={formData.name}
                  onChange={(e) => setFormData({ ...formData, name: e.target.value })}
                  className="w-full bg-white border-2 border-gray-300 rounded-lg px-4 py-2 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                  required
                />
              </div>

              <div>
                <label className="block mb-2 font-semibold text-gray-700">Marca *</label>
                <input
                  type="text"
                  value={formData.brand}
                  onChange={(e) => setFormData({ ...formData, brand: e.target.value })}
                  className="w-full bg-white border-2 border-gray-300 rounded-lg px-4 py-2 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                  required
                />
              </div>

              <div>
                <label className="block mb-2 font-semibold text-gray-700">Categoría *</label>
                <select
                  value={formData.category}
                  onChange={(e) => setFormData({ ...formData, category: e.target.value })}
                  className="w-full bg-white border-2 border-gray-300 rounded-lg px-4 py-2 text-gray-900 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                  required
                >
                  <option value="">Selecciona una categoría</option>
                  {categories.map((cat) => (
                    <option key={cat} value={cat}>{cat}</option>
                  ))}
                </select>
              </div>

              <div>
                <label className="block mb-2 font-semibold text-gray-700">Stock *</label>
                <input
                  type="number"
                  min="0"
                  value={formData.stock}
                  onChange={(e) => setFormData({ ...formData, stock: parseInt(e.target.value) || 0 })}
                  className="w-full bg-white border-2 border-gray-300 rounded-lg px-4 py-2 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                  required
                />
              </div>

              <div>
                <label className="block mb-2 font-semibold text-gray-700">Precio (€) *</label>
                <input
                  type="number"
                  min="0"
                  step="0.01"
                  value={(formData.price_cents / 100).toFixed(2)}
                  onChange={(e) => setFormData({ ...formData, price_cents: Math.round(parseFloat(e.target.value) * 100) || 0 })}
                  className="w-full bg-white border-2 border-gray-300 rounded-lg px-4 py-2 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                  required
                />
              </div>

              <div>
                <label className="block mb-2 font-semibold text-gray-700">Imagen del Producto</label>
                <div
                  className={`border-2 border-dashed rounded-lg p-6 text-center transition-colors ${
                    isDragging
                      ? 'border-blue-500 bg-blue-50'
                      : 'border-gray-300 bg-gray-50 hover:border-gray-400'
                  }`}
                  onDragOver={(e) => {
                    e.preventDefault();
                    setIsDragging(true);
                  }}
                  onDragLeave={() => setIsDragging(false)}
                  onDrop={(e) => {
                    e.preventDefault();
                    setIsDragging(false);
                    const file = e.dataTransfer.files[0];
                    if (file && file.type.startsWith('image/')) {
                      handleImageUpload(file);
                    }
                  }}
                >
                  {formData.image_url ? (
                    <div className="space-y-2">
                      <img
                        src={`http://localhost:8000${formData.image_url}`}
                        alt="Preview"
                        className="max-w-full max-h-48 mx-auto rounded-lg"
                        onError={(e) => {
                          const target = e.target as HTMLImageElement;
                          target.style.display = 'none';
                        }}
                      />
                      <div className="flex gap-2 justify-center">
                        <button
                          type="button"
                          onClick={() => setFormData({ ...formData, image_url: '' })}
                          className="text-red-600 hover:text-red-800 text-sm font-medium"
                        >
                          Eliminar imagen
                        </button>
                      </div>
                    </div>
                  ) : (
                    <div>
                      <div className="text-4xl mb-2">📷</div>
                      <p className="text-gray-600 mb-2">
                        Arrastra y suelta una imagen aquí
                      </p>
                      <p className="text-gray-400 text-sm mb-4">o</p>
                      <label className="cursor-pointer">
                        <span className="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition inline-block">
                          Seleccionar archivo
                        </span>
                        <input
                          type="file"
                          accept="image/*"
                          className="hidden"
                          onChange={(e) => {
                            const file = e.target.files?.[0];
                            if (file) {
                              handleImageUpload(file);
                            }
                          }}
                          disabled={uploadingImage}
                        />
                      </label>
                      {uploadingImage && (
                        <p className="text-blue-600 mt-2 text-sm">Subiendo imagen...</p>
                      )}
                    </div>
                  )}
                </div>
              </div>
            </div>

            <div>
              <label className="block mb-2 font-semibold text-gray-700">Descripción</label>
              <textarea
                value={formData.description}
                onChange={(e) => setFormData({ ...formData, description: e.target.value })}
                className="w-full bg-white border-2 border-gray-300 rounded-lg px-4 py-2 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                rows={4}
              />
            </div>

            <div className="flex gap-4">
              <button
                type="submit"
                className="bg-green-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-green-700 transition flex items-center gap-2"
              >
                {editingProduct ? (
                  <>
                    <span className="text-white">💾</span>
                    <span>Guardar Cambios</span>
                  </>
                ) : (
                  <>
                    <span className="text-white text-lg font-bold leading-none">+</span>
                    <span>Crear Producto</span>
                  </>
                )}
              </button>
              <button
                type="button"
                onClick={() => {
                  resetForm();
                  setShowForm(false);
                }}
                className="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg font-semibold hover:bg-gray-400 transition"
              >
                Cancelar
              </button>
            </div>
          </form>
        </div>
      )}

      {loading ? (
        <div className="text-center py-12">
          <div className="text-4xl mb-4">⏳</div>
          <p className="text-gray-600">Cargando productos...</p>
        </div>
      ) : (
        <div className="bg-white rounded-lg shadow-lg overflow-hidden">
          <div className="overflow-x-auto">
            <table className="w-full">
              <thead className="bg-gray-100">
                <tr>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">ID</th>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Imagen</th>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Nombre</th>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Marca</th>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Categoría</th>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Stock</th>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Precio</th>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Acciones</th>
                </tr>
              </thead>
              <tbody className="bg-white divide-y divide-gray-200">
                {products.length === 0 ? (
                  <tr>
                    <td colSpan={8} className="px-6 py-8 text-center text-gray-500">
                      No hay productos disponibles
                    </td>
                  </tr>
                ) : (
                  products.map((product) => (
                    <tr key={product.id} className="hover:bg-gray-50">
                      <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{product.id}</td>
                      <td className="px-6 py-4 whitespace-nowrap">
                        {product.image_url ? (
                          <img
                            src={`http://localhost:8000${product.image_url}`}
                            alt={product.name}
                            className="w-16 h-16 object-contain"
                            onError={(e) => {
                              const target = e.target as HTMLImageElement;
                              target.style.display = 'none';
                            }}
                          />
                        ) : (
                          <div className="w-16 h-16 bg-gray-200 rounded flex items-center justify-center text-gray-400">
                            📦
                          </div>
                        )}
                      </td>
                      <td className="px-6 py-4 text-sm font-medium text-gray-900">{product.name}</td>
                      <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{product.brand}</td>
                      <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{product.category}</td>
                      <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{product.stock}</td>
                      <td className="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                        {(product.price_cents / 100).toFixed(2)}€
                      </td>
                      <td className="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div className="flex gap-2">
                          <button
                            onClick={() => handleEdit(product)}
                            className="text-blue-600 hover:text-blue-900 font-semibold"
                          >
                            ✏️ Editar
                          </button>
                          <button
                            onClick={() => handleDelete(product.id)}
                            className="text-red-600 hover:text-red-900 font-semibold"
                          >
                            🗑️ Eliminar
                          </button>
                        </div>
                      </td>
                    </tr>
                  ))
                )}
              </tbody>
            </table>
          </div>
        </div>
      )}
    </div>
  );
}

