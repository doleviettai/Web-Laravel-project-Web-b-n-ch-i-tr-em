<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
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
    public function boot(): void
    {
        //
        // if (Auth::check()) {
        //     $authUserRole = Auth::user()->role; // Giả sử `role` lưu vai trò của người dùng
        //     if ($authUserRole == 0) {
        //         Paginator::useBootstrapFive();
        //     } else if ($authUserRole == 1) {
        //         Paginator::useBootstrapFive();
        //     } else if ($authUserRole == 2) {
        //         Paginator::useTailwind();
        //     }
        // } else {
        //     // Mặc định nếu chưa đăng nhập
        //     Paginator::useTailwind();
        // }
    }
}
