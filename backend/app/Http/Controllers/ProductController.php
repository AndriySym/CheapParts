<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'stock' => ['required', 'integer', 'min:0'],
            'brand' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'image_url' => ['nullable', 'string'],
            'price_cents' => ['required', 'integer', 'min:0'],
        ]);

        $product = Product::create($validated);

        return response()->json($product, 201);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'stock' => ['sometimes', 'integer', 'min:0'],
            'brand' => ['sometimes', 'string', 'max:255'],
            'category' => ['sometimes', 'string', 'max:255'],
            'image_url' => ['nullable', 'string'],
            'price_cents' => ['sometimes', 'integer', 'min:0'],
        ]);

        // Si se está cambiando la imagen, eliminar la imagen antigua
        if (isset($validated['image_url']) && $product->image_url && $product->image_url !== $validated['image_url']) {
            $this->deleteImageFile($product->image_url);
        }

        $product->update($validated);

        return response()->json($product);
    }

    public function destroy(Product $product)
    {
        // Eliminar la imagen del producto si existe
        if ($product->image_url) {
            $this->deleteImageFile($product->image_url);
        }

        $product->delete();

        return response()->json(['message' => 'Producto eliminado correctamente'], 200);
    }

    /**
     * Elimina un archivo de imagen del storage
     */
    private function deleteImageFile(string $imageUrl): void
    {
        // Convertir /storage/products/filename.jpg a products/filename.jpg
        if (str_starts_with($imageUrl, '/storage/')) {
            $path = str_replace('/storage/', '', $imageUrl);
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        $image = $request->file('image');
        $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $path = $image->storeAs('products', $filename, 'public');

        return response()->json([
            'url' => '/storage/' . $path,
            'message' => 'Imagen subida correctamente',
        ]);
    }
}
