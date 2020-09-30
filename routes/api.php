<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

/* version 1 */

Route::group(['prefix' => 'v1'], function () {
    /* auth */
    Route::group(['prefix' => 'auth'], function () {
        Route::post('register', 'API\AuthController@register');
        Route::post('login', 'API\AuthController@login');
    });

    /* users */
    Route::group(['prefix' => 'users', 'middleware' => 'auth:api'], function () {
        Route::get('shortlist', 'UserController@shortlistIndex');
        Route::post('shortlist/{postId}', 'UserController@shortlist');
        Route::delete('shortlist/{postId}', 'UserController@unshortlist');
    });

    /* carts */
    Route::group(['prefix' => 'carts'], function () {
        Route::get('/count', 'API\CartController@count');
        Route::post('/check-stocks', 'API\CartController@checkStocks');
        Route::delete('/{cartId}', 'API\CartController@delete');
    });

    // forgot password
    Route::group(['prefix' => 'password'], function () {
        Route::post('forgot', 'Frontend\ForgotPasswordController@forgot');
        Route::post('reset', 'Frontend\ForgotPasswordController@reset');
    });
});
