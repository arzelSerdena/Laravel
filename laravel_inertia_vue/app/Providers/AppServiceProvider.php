<?php

namespace App\Providers;

use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Route::middleware(['auth', Admin::class])
        ->group(base_path('routes/web.php'));
    }
}
