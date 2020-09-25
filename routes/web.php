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

Route::name('frontend.auth.')
  ->namespace('Frontend\Auth')
  ->prefix('{locale}')
  ->where(['locale' => '[a-zA-Z]{2}'])
  ->middleware('setlocale')
  ->group(function () {
    Route::get('/login', 'LoginController@showLoginForm')->name('login.form');
    Route::post('/login', 'LoginController@login')->name('login');
    Route::post('/logout', 'LoginController@logout')->name('logout');
    Route::get('/login/{provider}', 'LoginController@redirectToProvider');
    Route::get('/login/{provier}/callback', 'LoginController@handleProviderCallback');
});

Route::name('frontend.')
  ->namespace('Frontend')
  ->prefix('{locale}')
  ->where(['locale' => '[a-zA-Z]{2}'])
  ->middleware('setlocale')
  ->group(function(){

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/product', 'ProductController@index')->name('product');
    Route::get('/product/{product}', 'ProductController@detail')->name('product-detail');
    Route::get('/cart', 'CartController@index')->name('cart');
    Route::post('/cart/order', 'CartController@order')->name('cart-order');
    Route::post('/pay', 'PayController@index')->name('pay');
    Route::post('/payment', 'PaymentController@index')->name('payment');

    Route::get('/register', 'UserController@create')->name('register');
    Route::name('user.')
      ->prefix('/user')
      ->group(function () {
          Route::get('/profile', 'UserController@edit')->name('profile');
          Route::get('/edit-password', 'UserController@edit_password')->name('edit-password');
          Route::get('/favorite', 'UserController@favorite')->name('favorite');
    });
    Route::resource('/user', 'UserController');

    Route::get('/auction', function () {
      return redirect()->away('https://www.google.com');
    })->name('auction');

    Route::get('get_district_list', 'AjaxController@get_district_list');
    Route::get('get_sub_district_list', 'AjaxController@get_sub_district_list');

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
  ->group(function(){

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

});


Auth::routes();

