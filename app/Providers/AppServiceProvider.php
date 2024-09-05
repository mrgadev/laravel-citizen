<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Http\Responses\LoginResponse;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton( LoginResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('Admin', function ($user) {
            return $user->role=='Admin';
        });
        Gate::define('Staff', function ($user) {
            return $user->role=='Staff';
        });
        Gate::define('Warga', function ($user) {
            return $user->role=='Warga';
        });
        Gate::define('Satpam', function ($user) {
            return $user->role=='Satpam';
        });
    }
}
