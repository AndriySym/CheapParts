<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ChatController;

// Public
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/filters/available', [ProductController::class, 'filters']);
Route::get('/products/{product}', [ProductController::class, 'show']);

// Chat (público, no requiere autenticación)
Route::post('/chat', [ChatController::class, 'chat']);

// Auth
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// Protected
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart', [CartController::class, 'store']);
    Route::put('/cart/{cartItem}', [CartController::class, 'update']);
    Route::delete('/cart/{cartItem}', [CartController::class, 'destroy']);

    // Orders
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{order}', [OrderController::class, 'show']);

    // Payment
    Route::post('/checkout/create-session', [PaymentController::class, 'createCheckoutSession']);
    Route::get('/checkout/success', [PaymentController::class, 'checkoutSuccess']);

    // Admin routes - Product management
    Route::middleware('admin')->group(function () {
        Route::post('/admin/products', [ProductController::class, 'store']);
        Route::put('/admin/products/{product}', [ProductController::class, 'update']);
        Route::delete('/admin/products/{product}', [ProductController::class, 'destroy']);
        Route::post('/admin/products/upload-image', [ProductController::class, 'uploadImage']);
    });
});

// Stripe Webhook (sin middleware auth porque usa firma de Stripe)
Route::post('/webhook/stripe', [PaymentController::class, 'webhook']);







