<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace' => 'App\Http\Controllers\Admin',
], function () {
    Route::crud('order', 'OrderCrudController');
    Route::crud('user', 'UserCrudController');
    Route::crud('product', 'ProductCrudController');
    Route::crud('product-color', 'ProductColorCrudController');
    Route::crud('news', 'NewsCrudController');
    Route::crud('review', 'ReviewCrudController');
    Route::crud('service', 'ServiceCrudController');
});
