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
        $product = \App\Models\CatalogProduct::findOrFail($id);

        return Inertia::render('ProductShow', [
            'product' => $product,
        ]);
    }


    public function index()
    {
        $products = Product::paginate(16); // 16 товаров на страницу

        return response()->json($products);
    }

}
