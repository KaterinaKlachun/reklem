<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ServiceController;


use App\Models\CatalogProduct;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Страница для создания заявки
    Route::get('/order', function () {
        return Inertia::render('OrderPage'); // Компонент OrderPage
    })->name('orders.create');

    // Обработка отправки заявки
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
});



Route::get('/catalog', function () {
    return Inertia::render('CatalogPage');
});
Route::get('/catalog-products', function (Request $request) {
    $category = $request->query('category');

    if ($category) {
        return CatalogProduct::where('category', $category)->get();
    }

    return CatalogProduct::all();
});
Route::get('/popular-products', [ProductController::class, 'popular']);
Route::get('/news', [NewsController::class, 'index']);
Route::get('/about', [AboutController::class, 'index']);
Route::get('/contacts', [ContactController::class, 'index']);
Route::get('/reviews', [ReviewController::class, 'index'])
    ->name('reviews.index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/portfolio', [PortfolioController::class, 'index']);
Route::get('/services', [ServiceController::class, 'index']);

require __DIR__.'/auth.php';
