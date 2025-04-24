<?php

// app/Http/Controllers/CatalogController.php
namespace App\Http\Controllers;

use App\Models\CatalogProduct;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
    {
        $categories = CatalogProduct::select('category')->distinct()->get();
        $products = CatalogProduct::paginate(12);

        return view('catalog.index', compact('categories', 'products'));
    }

    public function filterByCategory(Request $request)
    {
        $category = $request->input('category');
        $products = CatalogProduct::where('category', $category)->paginate(12);

        return response()->json($products);
    }
}
