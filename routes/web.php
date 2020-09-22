<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('frontend.home', ['locale' => app()->getLocale()]));
});

Route::name('frontend.')
    ->namespace('Frontend')
    ->prefix('{locale}')
    ->where(['locale' => '[a-zA-Z]{2}'])
    ->middleware('setlocale')
    ->group(function () {

        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/product', 'ProductController@index')->name('product');
        Route::get('/product/{product}', 'ProductController@detail')->name('product-detail');
        Route::get('/cart', 'CartController@index')->name('cart');
        Route::get('/payment', 'PaymentController@index')->name('payment');

        Route::get('/auction', function () {
            return redirect()->away('https://www.google.com');
        })->name('auction');

        Route::get('/lang', function () {
            return back()->withInput(['locale' => app()->getLocale()]);
            //return redirect(route('frontend.home', ['locale' => app()->getLocale()]));
        });

        /* Sitemap Route*/
        Route::get('/sitemap.xml', 'SitemapController@index')->name('sitemap.xml');
        Route::get('/sitemap.xml/reviews', 'SitemapController@reviews');
    });

Route::name('frontend.')
    ->namespace('Frontend')
    ->group(function () {

        set_time_limit(0);

        Route::get('/clearCache', function () {
            Cache::flush();
            // $exitCode = Artisan::call('config:cache');
            return 'Cache Clear';
        });

        Route::get('/clearConfig', function () {
            $exitCode = Artisan::call('config:clear');
            return 'Config Clear';
        });

        Route::get('/createKey', function () {
            Artisan::call('key:generate');
            return 'Success';
        });

        Route::get('/createLink', function () {
            Artisan::call('storage:link');
            return 'Success';
        });

        Route::get('/migrate', function () {
            Artisan::call('migrate:fresh --seed');
            return 'Success';
        });
    });


Auth::routes();
