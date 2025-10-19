<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // ✅ ربط ملف api.php يدويًا لضمان تحميله دائمًا
        Route::prefix('api')
            ->middleware('api')
            ->group(base_path('routes/api.php'));
    }
}