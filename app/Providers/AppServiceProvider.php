<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Dedoc\Scramble\Scramble;

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
        // Mengatur akses rute Scramble agar bisa dibuka
        Scramble::routes(function (\Illuminate\Routing\Route $route) {
            return Str::startsWith($route->uri(), 'api/');
        });
    }
}