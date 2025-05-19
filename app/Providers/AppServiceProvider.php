<?php

namespace App\Providers;

use App\Models\Banner;
use App\Models\Profile;
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
        // view composers
        view()->composer('layouts.backend', function ($view) {
            $view->with('profile', Profile::latest()->first()->get());
        });
    }
}
