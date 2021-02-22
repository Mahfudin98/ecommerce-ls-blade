<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

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
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');
        view()->composer('customer.*', 'App\Http\View\CategoryComposer');
        view()->composer('layouts.module.header', 'App\Http\View\CartComposer');
        view()->composer('layouts.module.footer', 'App\Http\View\ProductComposer');
        view()->composer('layouts.template', 'App\Http\View\CustomerServiceComposer');
    }
}
