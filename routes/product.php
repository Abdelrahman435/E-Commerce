<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use Illuminate\Support\Facades\Route;

Route::prefix('products')->group(function () {

    // Public
    Route::get('/', [ProductController::class,'index']);
    Route::get('{product}', [ProductController::class,'show']);

    // Protected
    Route::middleware('auth:api')->group(function () {

        Route::post('/', [ProductController::class,'store']);
        Route::put('{product}', [ProductController::class,'update']);
        Route::delete('{product}', [ProductController::class,'destroy']);

        // Upload Images
        Route::post('{product}/images', [ProductImageController::class,'upload']);
    });
});
