<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
            $session = Session::retrieve($sessionId);
            
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
                
                Log::info('Payment successful', [
                    'session_id' => $session->id,
                    'user_id' => $session->metadata->user_id ?? null,
                    'amount' => $session->amount_total,
                ]);
                
                // Aquí podrías crear el pedido en la base de datos
            }

            return response()->json(['status' => 'success']);
            
        } catch (\Exception $e) {
            Log::error('Webhook error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
