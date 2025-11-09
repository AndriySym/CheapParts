<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Búsqueda por texto
        if ($search = $request->string('q')->toString()) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('brand', 'like', "%$search%")
                  ->orWhere('category', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%");
            });
        }

        // Filtro por categoría
        if ($category = $request->string('category')->toString()) {
            $query->where('category', $category);
        }

        // Filtro por marca
        if ($brand = $request->string('brand')->toString()) {
            $query->where('brand', $brand);
        }

        // Filtro por rango de precio (en céntimos)
        if ($minPrice = $request->integer('min_price')) {
            $query->where('price_cents', '>=', $minPrice);
        }

        if ($maxPrice = $request->integer('max_price')) {
            $query->where('price_cents', '<=', $maxPrice);
        }

        // Filtro por disponibilidad de stock
        if ($request->boolean('in_stock')) {
            $query->where('stock', '>', 0);
        }

        // Ordenamiento
        $sortBy = $request->string('sort_by')->toString();
        $sortOrder = $request->string('sort_order', 'asc')->toString();

        switch ($sortBy) {
            case 'price':
                $query->orderBy('price_cents', $sortOrder);
                break;
            case 'name':
                $query->orderBy('name', $sortOrder);
                break;
            case 'stock':
                $query->orderBy('stock', $sortOrder);
                break;
            default:
                $query->orderBy('id', 'desc');
        }

        return $query->paginate(12);
    }

    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Obtiene todas las categorías y marcas únicas para filtros
     */
    public function filters()
    {
        $categories = Product::select('category')
            ->distinct()
            ->whereNotNull('category')
            ->orderBy('category')
            ->pluck('category');

        $brands = Product::select('brand')
            ->distinct()
            ->whereNotNull('brand')
            ->orderBy('brand')
            ->pluck('brand');

        $priceRange = Product::selectRaw('MIN(price_cents) as min, MAX(price_cents) as max')
            ->first();

        return response()->json([
            'categories' => $categories,
            'brands' => $brands,
            'price_range' => [
                'min' => $priceRange->min ?? 0,
                'max' => $priceRange->max ?? 0,
            ],
        ]);
    }

    public function store(Request $request)
    {
        abort(405);
    }

    public function update(Request $request, string $id)
    {
        abort(405);
    }

    public function destroy(string $id)
    {
        abort(405);
    }
}
