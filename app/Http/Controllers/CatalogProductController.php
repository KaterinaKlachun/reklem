<?php

namespace App\Http\Controllers;

use App\Models\CatalogProduct;
use Illuminate\Http\Request;

class CatalogProductController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');

        $query = CatalogProduct::query();

        if ($category) {
            $query->where('category', $category);
        }

        return response()->json($query->get());
    }
}
