<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\CatalogProduct;
use App\Http\Controllers\{
    AboutController,
    CartController,
    ContactController,
    DashboardController,
    DataProcessingController,
    NewsController,
    PaymentController,
    PortfolioController,
    ProductController,
    ProfileController,
    ReturnExchangeController,
    ReviewController,
    ServiceController
};

// Главная страница
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Публичные страницы
Route::get('/catalog', fn () => Inertia::render('CatalogPage'));
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
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.front.show'); // ✅ изменено имя маршрута
Route::get('/portfolio', [PortfolioController::class, 'index']);
Route::get('/services', [ServiceController::class, 'index']);
Route::get('/constructor', [ProductController::class, 'constructor'])->name('product.constructor');
Route::post('/upload-user-image', [ProductController::class, 'uploadUserImage'])->name('product.uploadImage');
Route::get('/returnexchange', [ReturnExchangeController::class, 'index']);
Route::get('/dataprocessing', [DataProcessingController::class, 'index']);

// Контактная форма
Route::post('/contact', function (Request $request) {
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
    ]);

    \Log::info('Заявка с формы:', $data);

    return response()->json(['message' => 'Спасибо, заявка получена!']);
});

// Приватные маршруты
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Профиль
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/photo', [ProfileController::class, 'updateProfilePhoto'])->name('profile.photo.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Корзина и оплата
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add', [CartController::class, 'add'])->name('add');
        Route::patch('/{cartItem}', [CartController::class, 'update'])->name('update');
        Route::delete('/{cartItem}', [CartController::class, 'remove'])->name('remove');
        Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
        Route::get('/checkout', fn () => Inertia::render('PaymentPage'))->name('checkout.page');
        Route::post('/payment/confirm', [PaymentController::class, 'confirm'])->name('payment.confirm');
    });
});

// Авторизация
require __DIR__ . '/auth.php';
