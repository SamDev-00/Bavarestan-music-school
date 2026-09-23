<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // هلپرها را مستقیم بارگذاری می‌کنیم تا روی سرور نیازی به اجرای
        // «composer dump-autoload» نباشد؛ توابع با function_exists محافظت شده‌اند.
        require_once app_path('Support/helpers.php');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
