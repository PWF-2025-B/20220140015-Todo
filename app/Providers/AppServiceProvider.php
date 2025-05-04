<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;

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
        // Gunakan Tailwind untuk pagination
        Paginator::useTailwind();

        // Definisikan gate untuk admin
        Gate::define('admin', function ($user) {
            return $user->is_admin == true;
        });
    }
}
