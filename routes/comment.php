<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::prefix('products/{product}/comments')
    ->middleware('auth:api')
    ->group(function () {

        // Create
        Route::post('/', [CommentController::class,'store']);
    });

Route::prefix('comments')->middleware('auth:api')->group(function () {

    // Authorization handled بواسطة policy
    Route::put('{comment}', [CommentController::class,'update'])
        ->middleware('can:update,comment');

    Route::delete('{comment}', [CommentController::class,'destroy'])
        ->middleware('can:delete,comment');
});
