<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('customer.*', 'App\Http\View\CategoryComposer');
        view()->composer('layouts.module.header', 'App\Http\View\CartComposer');
        view()->composer('layouts.module.footer', 'App\Http\View\ProductComposer');
        view()->composer('layouts.template', 'App\Http\View\CustomerServiceComposer');
    }
}
