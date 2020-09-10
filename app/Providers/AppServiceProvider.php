<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
// use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
  public function register()
  {
    //
  }

  public function boot()
  {
    View::composer('frontend.*', function($view) {
      $view->with('main', get_main());
    });

    Schema::defaultStringLength(255);

    // custom view for pagination
    // Paginator::defaultView('vendor.pagination.bootstrap-4');
    // Paginator::defaultSimpleView('vendor.pagination.simple-bootstrap-4');
  }
}

