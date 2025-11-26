<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use App\Models\Product;
use App\Models\Comment;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        parent::boot();

        Route::model('product', Product::class);
        Route::model('comment', Comment::class);
        $this->routes(function () {

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/auth.php'));

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/product.php'));

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/comment.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
