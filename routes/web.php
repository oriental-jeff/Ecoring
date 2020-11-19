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

Auth::routes(['verify' => true]);

Route::name('frontend.auth.')
    ->namespace('Frontend\Auth')
    ->prefix('{locale}')
    ->where(['locale' => '[a-zA-Z]{2}'])
    ->middleware(['setlocale'])
    ->group(function () {
        Route::get('/login', 'LoginController@showLoginForm')->name('login.form');
        Route::post('/login', 'LoginController@login')->name('login');
        Route::post('/logout', 'LoginController@logout')->name('logout')->middleware('front_user.active');
    });

Route::name('frontend.')
    ->namespace('Frontend')
    ->prefix('{locale}')
    ->where(['locale' => '[a-zA-Z]{2}'])
    ->middleware('setlocale')
    ->group(function () {
        Route::get('/auth/{provider}', 'SocialAccountController@redirectToProvider')->name('auth.provider');
        Route::get('/deauth/{provider}', 'SocialAccountController@deauthorizeProvider')->name('deauth.provider');
        Route::get('/auth/{provier}/callback', 'SocialAccountController@handleProviderCallback')->name('auth.provider.callback');

        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/product', 'ProductController@index')->name('product');
        Route::get('/product/{product}', 'ProductController@detail')->name('product-detail');

        Route::get('/cart', 'CartController@index')->name('cart')->middleware('front_user.active');
        Route::post('/cart/order', 'CartController@order')->name('cart-order')->middleware('front_user.active');
        Route::post('/pay', 'PayController@index')->name('pay')->middleware('front_user.active');
        Route::post('/pay/success', 'PayController@store')->name('pay-success')->middleware('front_user.active');
        Route::get('/payment', 'PaymentController@index')->name('payment')->middleware('front_user.active');
        Route::post('/payment/success', 'PaymentController@store')->name('payment-success')->middleware('front_user.active');
        Route::get('/payment/invoice', 'PaymentController@send_email')->name('payment-invoice');

        Route::get('/register', 'UserController@create')->name('register');
        Route::get('/verify-resend', 'UserController@verify_resend')->name('verify-resend');

        Route::name('user.')
            ->prefix('/user')
            ->group(function () {
                Route::get('/profile', 'UserController@edit')->name('profile')->middleware('verified');
                Route::get('/edit-password', 'UserController@edit_password')->name('edit-password')->middleware('verified');
                Route::get('/favorite', 'UserController@favorite')->name('favorite')->middleware('front_user.active');
                Route::get('/history', 'UserController@history')->name('history')->middleware('verified');
                Route::get('/history/detail/{order_id}', 'UserController@detail')->name('history-detail')->middleware('verified');
            });
        Route::resource('/user', 'UserController');

        Route::get('forgot_password', 'ForgotPasswordController@index')->name('password.reset');
        Route::post('forgot_password_reset', 'ForgotPasswordController@forgot')->name('password.forgot');

        Route::get('/auction', function () {
            return redirect()->away('https://www.google.com');
        })->name('auction');

        Route::get('get_district_list', 'AjaxController@get_district_list');
        Route::get('get_sub_district_list', 'AjaxController@get_sub_district_list');
        Route::get('change_favorite', 'AjaxController@change_favorite');
        Route::get('add_cart', 'AjaxController@add_cart');
        Route::get('remove_cart', 'AjaxController@remove_cart');
        Route::get('cancel_order', 'AjaxController@cancel_order');
        Route::get('check_order', 'AjaxController@check_order');
        Route::get('reset_product_on_cart', 'AjaxController@resetProductOnCart');

        Route::get('/lang', function () {
            return back()->withInput(['locale' => app()->getLocale()]);
            //return redirect(route('frontend.home', ['locale' => app()->getLocale()]));
        });

        /* Sitemap Route*/
        Route::get('/sitemap.xml', 'SitemapController@index')->name('sitemap.xml');
        Route::get('/sitemap.xml/reviews', 'SitemapController@reviews');

        // Knowledge Page
        Route::get('/knowledge', 'KnowledgeController@index')->name('knowledge');
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

        Route::get('/createTable', function () {
            // Artisan::call('make:migration create_user_profile_table');
            // Artisan::call('make:migration create_user_address_deliveries_table');
            return 'Create Migrate Table Success';
        });

        Route::get('/createSeeder', function () {
            // Artisan::call('make:seeder CategorySeeder');
            // Artisan::call('make:seeder WarehouseSeeder');
            return 'Create Seeder Success';
        });

        Route::get('/createMail', function () {
            Artisan::call('vendor:publish --tag=laravel-mail');
            // Artisan::call('make:migration create_user_address_deliveries_table');
            return 'Create Mail Template Success';
        });

        Route::get('/runSeeder', function () {
            Artisan::call('db:seed --class=ProductTestSeeder');
            return 'Run Seeder Success';
        });

    });


// Auth::routes();
