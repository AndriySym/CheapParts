<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $items = CartItem::with('product')
            ->where('user_id', $request->user()->id)
            ->get();
        return $items;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['nullable', 'integer', 'min:1'],
        ]);

        $quantity = $validated['quantity'] ?? 1;
        $product = Product::findOrFail($validated['product_id']);

        // Verificar stock disponible
        $item = CartItem::where('user_id', $request->user()->id)
            ->where('product_id', $validated['product_id'])
            ->first();
        
        $currentQuantity = $item ? $item->quantity : 0;
        $newQuantity = $currentQuantity + $quantity;

        if ($product->stock < $newQuantity) {
            return response()->json([
                'error' => 'stock_insufficient',
                'message' => $product->stock === 0 
                    ? "Lo sentimos, este producto ya no está disponible. No hay stock disponible."
                    : "Stock insuficiente. Solo hay {$product->stock} unidad(es) disponible(s).",
                'available_stock' => $product->stock,
            ], 422);
        }

        if ($item) {
            $item->quantity = $newQuantity;
            $item->save();
        } else {
            $item = CartItem::create([
                'user_id' => $request->user()->id,
                'product_id' => $validated['product_id'],
                'quantity' => $quantity,
            ]);
        }

        return response()->json($item->load('product'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(405);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CartItem $cartItem)
    {
        if ($cartItem->user_id !== $request->user()->id) {
            abort(403);
        }
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $product = $cartItem->product;

        // Verificar stock disponible
        if ($product->stock < $validated['quantity']) {
            return response()->json([
                'error' => 'stock_insufficient',
                'message' => $product->stock === 0 
                    ? "Lo sentimos, este producto ya no está disponible. No hay stock disponible."
                    : "Stock insuficiente. Solo hay {$product->stock} unidad(es) disponible(s).",
                'available_stock' => $product->stock,
            ], 422);
        }

        $cartItem->update(['quantity' => $validated['quantity']]);
        return $cartItem->load('product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, CartItem $cartItem)
    {
        if ($cartItem->user_id !== $request->user()->id) {
            abort(403);
        }
        $cartItem->delete();
        return response()->json(['ok' => true]);
    }
}
