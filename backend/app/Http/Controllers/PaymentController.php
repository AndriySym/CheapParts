<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PaymentController extends Controller
{
    public function __construct()
    {
        $stripeSecret = config('services.stripe.secret');
        
        if (!$stripeSecret) {
            Log::error('Stripe secret key not configured');
            abort(500, 'Stripe no está configurado. Configura STRIPE_SECRET en el archivo .env');
        }
        
        Stripe::setApiKey($stripeSecret);
    }

    public function createCheckoutSession(Request $request)
    {
        try {
            $user = $request->user();
            
            if (!$user) {
                return response()->json(['error' => 'Usuario no autenticado'], 401);
            }

            $cartItems = $request->input('items', []);
            
            if (empty($cartItems)) {
                return response()->json(['error' => 'El carrito está vacío'], 400);
            }

            $lineItems = [];
            foreach ($cartItems as $item) {
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'eur',
                        'unit_amount' => $item['price_cents'],
                        'product_data' => [
                            'name' => $item['name'],
                            'description' => $item['brand'] ?? '',
                        ],
                    ],
                    'quantity' => $item['quantity'],
                ];
            }

            $frontendUrl = config('app.frontend_url', 'http://localhost:5173');

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => $frontendUrl . '/checkout/success?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => $frontendUrl . '/cart',
                'customer_email' => $user->email,
                'metadata' => [
                    'user_id' => $user->id,
                ],
            ]);

            return response()->json([
                'sessionId' => $session->id,
                'url' => $session->url,
            ]);

        } catch (\Stripe\Exception\ApiErrorException $e) {
            Log::error('Stripe API error: ' . $e->getMessage(), [
                'user_id' => $request->user()->id ?? null,
                'error' => $e->getMessage()
            ]);
            
            return response()->json([
                'error' => 'Error al comunicarse con Stripe: ' . $e->getMessage()
            ], 500);
            
        } catch (\Exception $e) {
            Log::error('Payment error: ' . $e->getMessage(), [
                'user_id' => $request->user()->id ?? null,
                'error' => $e->getMessage()
            ]);
            
            return response()->json([
                'error' => 'Error al procesar el pago: ' . $e->getMessage()
            ], 500);
        }
    }

    public function checkoutSuccess(Request $request)
    {
        $sessionId = $request->query('session_id');
        
        if (!$sessionId) {
            return response()->json(['error' => 'Session ID no proporcionado'], 400);
        }

        try {
            $user = $request->user();
            if (!$user) {
                return response()->json(['error' => 'Usuario no autenticado'], 401);
            }

            $session = Session::retrieve($sessionId);
            
            // Verificar si el pago fue exitoso
            if ($session->payment_status === 'paid') {
                // Verificar si el pedido ya existe (evitar duplicados)
                $existingOrder = Order::where('stripe_session_id', $sessionId)->first();
                
                if (!$existingOrder) {
                    // Obtener items del carrito antes de limpiarlo
                    $cartItems = CartItem::with('product')
                        ->where('user_id', $user->id)
                        ->get();
                    
                    if ($cartItems->isEmpty()) {
                        Log::warning('Cart is empty when creating order', [
                            'user_id' => $user->id,
                            'session_id' => $sessionId
                        ]);
                    } else {
                        // Calcular el total
                        $totalCents = $cartItems->sum(function ($item) {
                            return $item->product->price_cents * $item->quantity;
                        });
                        
                        // Crear el pedido
                        DB::transaction(function () use ($user, $session, $cartItems, $totalCents) {
                            // Verificar stock antes de crear el pedido
                            foreach ($cartItems as $cartItem) {
                                $product = $cartItem->product;
                                if ($product->stock < $cartItem->quantity) {
                                    throw new \Exception("Stock insuficiente para el producto: {$product->name}. Stock disponible: {$product->stock}, solicitado: {$cartItem->quantity}");
                                }
                            }
                            
                            $order = Order::create([
                                'user_id' => $user->id,
                                'total_cents' => $totalCents,
                                'status' => 'completed',
                                'stripe_session_id' => $session->id,
                                'stripe_payment_intent_id' => $session->payment_intent ?? null,
                            ]);
                            
                            // Crear los items del pedido y descontar stock
                            foreach ($cartItems as $cartItem) {
                                OrderItem::create([
                                    'order_id' => $order->id,
                                    'product_id' => $cartItem->product_id,
                                    'quantity' => $cartItem->quantity,
                                    'price_cents' => $cartItem->product->price_cents,
                                ]);
                                
                                // Descontar stock del producto
                                $product = Product::find($cartItem->product_id);
                                $product->decrement('stock', $cartItem->quantity);
                            }
                            
                            // Limpiar el carrito
                            CartItem::where('user_id', $user->id)->delete();
                            
                            Log::info('Order created successfully', [
                                'order_id' => $order->id,
                                'user_id' => $user->id,
                                'session_id' => $session->id,
                                'total' => $totalCents
                            ]);
                        });
                    }
                }
            }
            
            return response()->json([
                'success' => true,
                'session' => [
                    'id' => $session->id,
                    'payment_status' => $session->payment_status,
                    'customer_email' => $session->customer_email,
                    'amount_total' => $session->amount_total,
                ],
            ]);
        } catch (\Exception $e) {
            Log::error('Error retrieving checkout session: ' . $e->getMessage());
            return response()->json(['error' => 'Error al obtener información del pago'], 500);
        }
    }

    public function webhook(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $endpointSecret = config('services.stripe.webhook_secret');

        try {
            if ($endpointSecret) {
                $event = \Stripe\Webhook::constructEvent(
                    $payload,
                    $sigHeader,
                    $endpointSecret
                );
            } else {
                $event = json_decode($payload, false);
            }

            if ($event->type === 'checkout.session.completed') {
                $session = $event->data->object;
                $userId = $session->metadata->user_id ?? null;
                
                Log::info('Payment successful via webhook', [
                    'session_id' => $session->id,
                    'user_id' => $userId,
                    'amount' => $session->amount_total,
                ]);
                
                if ($userId && $session->payment_status === 'paid') {
                    // Verificar si el pedido ya existe (evitar duplicados)
                    $existingOrder = Order::where('stripe_session_id', $session->id)->first();
                    
                    if (!$existingOrder) {
                        // Obtener items del carrito
                        $cartItems = CartItem::with('product')
                            ->where('user_id', $userId)
                            ->get();
                        
                        if (!$cartItems->isEmpty()) {
                            // Calcular el total
                            $totalCents = $cartItems->sum(function ($item) {
                                return $item->product->price_cents * $item->quantity;
                            });
                            
                            // Crear el pedido
                            DB::transaction(function () use ($userId, $session, $cartItems, $totalCents) {
                                // Verificar stock antes de crear el pedido
                                foreach ($cartItems as $cartItem) {
                                    $product = $cartItem->product;
                                    if ($product->stock < $cartItem->quantity) {
                                        throw new \Exception("Stock insuficiente para el producto: {$product->name}. Stock disponible: {$product->stock}, solicitado: {$cartItem->quantity}");
                                    }
                                }
                                
                                $order = Order::create([
                                    'user_id' => $userId,
                                    'total_cents' => $totalCents,
                                    'status' => 'completed',
                                    'stripe_session_id' => $session->id,
                                    'stripe_payment_intent_id' => $session->payment_intent ?? null,
                                ]);
                                
                                // Crear los items del pedido y descontar stock
                                foreach ($cartItems as $cartItem) {
                                    OrderItem::create([
                                        'order_id' => $order->id,
                                        'product_id' => $cartItem->product_id,
                                        'quantity' => $cartItem->quantity,
                                        'price_cents' => $cartItem->product->price_cents,
                                    ]);
                                    
                                    // Descontar stock del producto
                                    $product = Product::find($cartItem->product_id);
                                    $product->decrement('stock', $cartItem->quantity);
                                }
                                
                                // Limpiar el carrito
                                CartItem::where('user_id', $userId)->delete();
                                
                                Log::info('Order created via webhook', [
                                    'order_id' => $order->id,
                                    'user_id' => $userId,
                                    'session_id' => $session->id
                                ]);
                            });
                        }
                    }
                }
            }

            return response()->json(['status' => 'success']);
            
        } catch (\Exception $e) {
            Log::error('Webhook error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
