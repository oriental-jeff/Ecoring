<?php

//use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
|
|
*/

Route::get('/', function () {
    return redirect()->route('backend.profile.index');
});

//Auth::routes();
Route::name('backend.auth.')
    ->namespace('Backend\Auth')
    ->group(function () {
        Route::get('/login', 'LoginController@showLoginForm')->name('login.form');
        Route::post('/login', 'LoginController@login')->name('login');
        Route::post('/logout', 'LoginController@logout')->name('logout');
    });


//Backend group
Route::name('backend.')
    ->namespace('Backend')
    /*  ->prefix('/backend')*/
    ->middleware(['backend.auth', 'user.active'])
    ->group(function () {
        // Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

        Route::get('/home', function () {
            // return redirect()->route('backend.dashboard');
            return redirect()->route("backend.profile.index");
        });

        // Trash
        Route::name('trash.')
            ->prefix('/trash')
            ->group(function () {
                Route::get('/', 'TrashController@index')->name('index');
                Route::get('/{model}/restore-all', 'TrashController@restoreAll')->name('restore-all');
                Route::get('/{model}/remove-all', 'TrashController@removeAll')->name('remove-all');
                Route::get('/{model}/{modelId}/restore', 'TrashController@restore')->name('restore');
                Route::get('/{model}/{modelId}/remove', 'TrashController@remove')->name('remove');
            });

        //Role
        Route::name('role.')
            ->prefix('/role')
            ->group(function () {
                Route::get('/search', 'RoleController@search')->name('search');
            });
        Route::resource('/role', 'RoleController');

        //User
        Route::name('user.')
            ->prefix('/user')
            ->group(function () {
                Route::get('/search', 'UserController@search')->name('search');
            });
        Route::resource('/user', 'UserController');

        Route::resource('/profile', 'ProfileController');

        Route::resource('/webinfo', 'WebInfoController');

        Route::resource('/about', 'AboutUsController');

        Route::name('websocial.')
            ->prefix('/websocial')
            ->group(function () {
                Route::get('/search', 'WebSocialController@search')->name('search');
            });
        Route::resource('/websocial', 'WebSocialController');

        Route::name('page.')
            ->prefix('/page')
            ->group(function () {
                Route::get('/search', 'PageController@search')->name('search');
            });
        Route::resource('/page', 'PageController');

        Route::name('banner.')
            ->prefix('/banner')
            ->group(function () {
                Route::get('/search', 'BannerController@search')->name('search');
            });
        Route::resource('/banner', 'BannerController');

        Route::name('menu.')
            ->prefix('/menu')
            ->group(function () {
                Route::get('/search', 'MenuController@search')->name('search');
                Route::post('/change_position', 'MenuController@change_position')->name('change_position');
                Route::get('/edit_name', 'MenuController@edit_name')->name('edit_name');
                Route::post('/update_name', 'MenuController@update_name')->name('update_name');
            });
        Route::resource('/menu', 'MenuController');

        Route::name('categories.')
            ->prefix('/categories')
            ->group(function () {
                Route::get('/search', 'CategoriesController@search')->name('search');
            });
        Route::resource('/categories', 'CategoriesController');

        Route::name('grades.')
            ->prefix('/grades')
            ->group(function () {
                Route::get('/search', 'GradesController@search')->name('search');
            });
        Route::resource('/grades', 'GradesController');

        //ck editor
        Route::name('ckeditor.')
            ->prefix('/ckeditor')
            ->group(function () {
                Route::post('/upload', 'CkeditorController@upload')->name('upload');
            });
        Route::get('ckeditor', 'CkeditorController@index');

        Route::name('dropzone.')
            ->prefix('/dropzone')
            ->group(function () {
                Route::post('/upload', 'DropzoneController@upload')->name('upload');
            });
    });
