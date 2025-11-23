import axios from 'axios';

const API_URL = import.meta.env.VITE_API_URL || 'http://localhost:8000/api';
// Base URL for images (remove /api from API_URL)
export const BASE_URL = API_URL.replace('/api', '') || 'http://localhost:8000';

export const api = axios.create({
  baseURL: API_URL,
  headers: {
    'Content-Type': 'application/json',
  },
});

// Add token to requests if available
api.interceptors.request.use((config) => {
  const token = localStorage.getItem('auth_token');
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});

// Handle 401 errors (token expired/invalid)
api.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response?.status === 401) {
      localStorage.removeItem('auth_token');
      window.location.href = '/login';
    }
    return Promise.reject(error);
  }
);

// API endpoints
export const authAPI = {
  register: (data: { name: string; email: string; password: string }) =>
    api.post('/auth/register', data),
  login: (data: { email: string; password: string }) =>
    api.post('/auth/login', data),
  me: () => api.get('/auth/me'),
  logout: () => api.post('/auth/logout'),
};

export const productsAPI = {
  getAll: (params?: { 
    q?: string; 
    page?: number;
    category?: string;
    brand?: string;
    min_price?: number;
    max_price?: number;
    in_stock?: boolean;
    sort_by?: string;
    sort_order?: string;
  }) =>
    api.get('/products', { params }),
  getOne: (id: number) => api.get(`/products/${id}`),
  getFilters: () => api.get('/products/filters/available'),
  create: (data: {
    name: string;
    description?: string;
    stock: number;
    brand: string;
    category: string;
    image_url?: string;
    price_cents: number;
  }) => api.post('/admin/products', data),
  update: (id: number, data: {
    name?: string;
    description?: string;
    stock?: number;
    brand?: string;
    category?: string;
    image_url?: string;
    price_cents?: number;
  }) => api.put(`/admin/products/${id}`, data),
  delete: (id: number) => api.delete(`/admin/products/${id}`),
  uploadImage: (file: File) => {
    const formData = new FormData();
    formData.append('image', file);
    return api.post('/admin/products/upload-image', formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    });
  },
};

export const cartAPI = {
  getItems: () => api.get('/cart'),
  addItem: (data: { product_id: number; quantity?: number }) =>
    api.post('/cart', data),
  updateItem: (id: number, data: { quantity: number }) =>
    api.put(`/cart/${id}`, data),
  removeItem: (id: number) => api.delete(`/cart/${id}`),
};

export const paymentAPI = {
  createCheckoutSession: (items: any[]) => api.post('/checkout/create-session', { items }),
  getCheckoutSuccess: (sessionId: string) =>
    api.get(`/checkout/success?session_id=${sessionId}`),
};

export const ordersAPI = {
  getAll: () => api.get('/orders'),
  getOne: (id: number) => api.get(`/orders/${id}`),
};

export const chatAPI = {
  sendMessage: (message: string, conversationHistory: Array<{ role: string; content: string }> = []) =>
    api.post('/chat', { message, conversation_history: conversationHistory }),
};

