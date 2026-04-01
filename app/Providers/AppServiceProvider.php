<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
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
        validator::extend('filter',function($attribute,$value,$parameters,$validator){
            return $value != 'laravel';
        },'The value of :attribute cannot be :value app service provider');

        Paginator::useBootstrap();
    }
}
