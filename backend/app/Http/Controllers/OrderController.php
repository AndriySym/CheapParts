<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        
        if (!$user) {
            return response()->json(['error' => 'Usuario no autenticado'], 401);
        }

        $orders = Order::where('user_id', $user->id)
            ->with(['items.product'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($orders);
    }

    public function show(Request $request, $id)
    {
        $user = $request->user();
        
        if (!$user) {
            return response()->json(['error' => 'Usuario no autenticado'], 401);
        }

        $order = Order::where('user_id', $user->id)
            ->with(['items.product'])
            ->findOrFail($id);

        return response()->json($order);
    }
}


