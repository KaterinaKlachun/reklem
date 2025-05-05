<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\CatalogProduct;
use Inertia\Inertia;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Public routes
Route::get('/catalog', function () {
    return Inertia::render('CatalogPage');
});
Route::get('/catalog-products', function (Request $request) {
    $category = $request->query('category');
    return $category
        ? CatalogProduct::where('category', $category)->get()
        : CatalogProduct::all();
});
Route::get('/popular-products', [ProductController::class, 'popular']);
Route::get('/news', [NewsController::class, 'index']);
Route::get('/about', [AboutController::class, 'index']);
Route::get('/contacts', [ContactController::class, 'index']);
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/portfolio', [PortfolioController::class, 'index']);
Route::get('/services', [ServiceController::class, 'index']);

// Auth routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/photo', [ProfileController::class, 'updateProfilePhoto'])->name('profile.photo.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart routes
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('/add', [CartController::class, 'add'])->name('cart.add');
        Route::patch('/{cartItem}', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
        Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
        Route::get('/checkout', fn () => Inertia::render('PaymentPage'))->name('checkout.page');
        Route::post('/payment/confirm', [PaymentController::class, 'confirm'])->name('payment.confirm');
    });
});

require __DIR__.'/auth.php';
