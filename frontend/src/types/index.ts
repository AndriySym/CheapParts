export interface User {
  id: number;
  name: string;
  email: string;
}

export interface Product {
  id: number;
  name: string;
  description: string | null;
  stock: number;
  brand: string | null;
  category: string | null;
  image_url: string | null;
  price_cents: number;
}

export interface CartItem {
  id: number;
  user_id: number;
  product_id: number;
  quantity: number;
  product: Product;
}

export interface AuthResponse {
  token: string;
  user: User;
}

export interface OrderItem {
  id: number;
  order_id: number;
  product_id: number;
  quantity: number;
  price_cents: number;
  product: Product;
}

export interface Order {
  id: number;
  user_id: number;
  total_cents: number;
  status: 'pending' | 'completed' | 'failed';
  stripe_session_id: string | null;
  stripe_payment_intent_id: string | null;
  created_at: string;
  updated_at: string;
  items: OrderItem[];
}

export interface CheckoutSessionResponse {
  sessionId: string;
  url: string;
}

