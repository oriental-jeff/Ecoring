<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
// use Illuminate\Pagination\Paginator;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        View::composer('frontend.*', function ($view) {
            $view->with('main', get_main());
        });

        Schema::defaultStringLength(255);

        Passport::routes();

        // custom view for pagination
        // Paginator::defaultView('vendor.pagination.bootstrap-4');
        // Paginator::defaultSimpleView('vendor.pagination.simple-bootstrap-4');
    }
}
