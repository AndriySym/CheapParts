<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;

// Public
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/filters/available', [ProductController::class, 'filters']);
Route::get('/products/{product}', [ProductController::class, 'show']);

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

    // Payment
    Route::post('/checkout/create-session', [PaymentController::class, 'createCheckoutSession']);
    Route::get('/checkout/success', [PaymentController::class, 'checkoutSuccess']);
});

// Stripe Webhook (sin middleware auth porque usa firma de Stripe)
Route::post('/webhook/stripe', [PaymentController::class, 'webhook']);







