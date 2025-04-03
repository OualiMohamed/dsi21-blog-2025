<?php

namespace App\Providers;


use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider; 


 /**
 * This class is responsible for registering application services and bootstrapping them.
 */
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
        Schema::defaultStringLength(191);
    }
}
