<?php
// use App\Http\Controllers\ProductController;
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AuthController;

// Route::get('', fn()=> to_route('products.index'));
// Route::resource('products', ProductController::class)->only(['index', 'show']);

// Route::get('login', fn()=> to_route('auth.create'))->name('login');
// Route::resource('auth', AuthController::class)->only(['create', 'store']);

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'OK';
});
