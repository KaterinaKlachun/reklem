<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function popular()
    {
        $products = \App\Models\CatalogProduct::orderByDesc('price')
            ->take(3)
            ->get(['id', 'title', 'image_url', 'price']);

        return response()->json($products);
    }

    public function show($id)
    {
        $product = Product::with('category', 'colors')->findOrFail($id);
        return response()->json($product);
    }

    public function index(Request $request)
    {
        // Пагинация с загрузкой категорий и цветов
        $products = Product::with(['category', 'colors']) // Загружаем связанные категории и цвета
        ->paginate(16); // 16 товаров на страницу

        return response()->json($products);
    }

}
