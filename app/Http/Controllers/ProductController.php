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

    // Метод для отображения товара с его цветами
    public function show($id)
    {
        // Загружаем продукт по id и связанные с ним цвета
        $product = Product::with('productColors')->findOrFail($id);

        // Возвращаем данные через Inertia
        return Inertia::render('ProductPage', [
            'product' => $product
        ]);
    }

    public function constructor()
    {
        // Получаем все продукты с их цветами
        $products = Product::with('productColors')->get();

        // Для отладки, добавим логирование
        \Log::info('Products with colors:', $products->toArray());

        // Отправляем данные на страницу конструктора
        return Inertia::render('ProductConstructor', [
            'products' => $products,
        ]);
    }

    // Метод для обработки загрузки пользовательского изображения
    public function uploadUserImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // ограничиваем типы и размер
        ]);

        $userImage = $request->file('image'); // получаем файл

        // Генерация уникального имени для изображения
        $imagePath = $userImage->storeAs('public/user_images', uniqid() . '.' . $userImage->extension());

        // Возвращаем URL для использования на фронтенде
        return response()->json([
            'image_url' => Storage::url($imagePath),
        ]);
    }

    public function index(Request $request)
    {
        // Пагинация с загрузкой категорий и цветов
        $products = Product::with(['category', 'colors']) // Загружаем связанные категории и цвета
        ->paginate(16); // 16 товаров на страницу

        return response()->json($products);
    }

}
