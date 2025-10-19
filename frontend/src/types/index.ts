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

