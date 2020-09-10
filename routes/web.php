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
  ->group(function(){

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/about', 'AboutController@index')->name('about');
    Route::get('/gallery', 'GalleryController@index')->name('gallery');
    Route::get('/gallery/{project}', 'GalleryController@detail')->name('project-detail');
    Route::get('/submission-requirement', 'SubmissionRequirementController@index')->name('submission-requirement');
    Route::get('/jury', 'JuryController@index')->name('jury');
    Route::get('/register', 'RegisterController@index')->name('register');

    Route::resource('/register-form', 'RegisterController');

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

});


Auth::routes();

