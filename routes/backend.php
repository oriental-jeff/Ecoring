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

        Route::resource('/policy', 'PolicyController');

        Route::resource('/knowledge', 'KnowledgeController');

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

        // Reports
        Route::name('reports.')->prefix('reports')->group(function() {
            Route::get('/', 'ReportsController@index');
            Route::get('/orders', 'ReportsController@orders')->name('orders');
        });

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

        Route::name('tags.')
            ->prefix('/tags')
            ->group(function () {
                Route::get('/search', 'TagsController@search')->name('search');
            });
        Route::resource('/tags', 'TagsController');

        Route::name('products.')
            ->prefix('/products')
            ->group(function () {
                Route::get('/search', 'ProductsController@search')->name('search');
            });
        Route::resource('/products', 'ProductsController');

        Route::name('product_prices.')
            ->prefix('/product_prices')
            ->group(function () {
                Route::get('/search', 'ProductPricesController@search')->name('search');
            });
        Route::resource('/product_prices', 'ProductPricesController');

        Route::name('promotions.')
            ->prefix('/promotions')
            ->group(function () {
                Route::get('/search', 'PromotionsController@search')->name('search');
            });
        Route::resource('/promotions', 'PromotionsController');

        Route::name('promotion_details.')
            ->prefix('/promotion_details')
            ->group(function () {
                Route::get('/search', 'PromotionDetailsController@search')->name('search');
            });
        Route::resource('/promotion_details', 'PromotionDetailsController');

        Route::name('branch.')
          ->prefix('/branch')
          ->group(function(){
            Route::get('/search', 'BranchController@search')->name('search');
        });
        Route::resource('/branch', 'BranchController');

        // Get Product promotion condition
        Route::get('/product/promotion', 'PromotionDetailsController@promotion');

        Route::name('stocks.')
            ->prefix('/stocks')
            ->group(function () {
                Route::get('/search', 'StocksController@search')->name('search');
            });
        Route::resource('/stocks', 'StocksController');

        Route::name('logistics.')
            ->prefix('/logistics')
            ->group(function () {
                Route::get('/search', 'LogisticsController@search')->name('search');
            });
        Route::resource('/logistics', 'LogisticsController');

        Route::name('logistic_rates.')
            ->prefix('/logistic_rates')
            ->group(function () {
                Route::get('/search', 'LogisticRatesController@search')->name('search');
            });
        Route::resource('/logistic_rates', 'LogisticRatesController');

        Route::name('bankaccounts.')
            ->prefix('/bankaccounts')
            ->group(function () {
                Route::get('/search', 'BankAccountsController@search')->name('search');
            });
        Route::resource('/bankaccounts', 'BankAccountsController');

        Route::name('orders.')
            ->prefix('/orders')
            ->group(function () {
                Route::get('/search', 'OrdersController@search')->name('search');
            });
        Route::resource('/orders', 'OrdersController');

        Route::name('payment_notifications.')
            ->prefix('/payment_notifications')
            ->group(function () {
                Route::get('/search', 'PaymentNotificationsController@search')->name('search');
            });
        Route::resource('/payment_notifications', 'PaymentNotificationsController');

        Route::name('transactions.')
            ->prefix('/transactions')
            ->group(function () {
                Route::get('/search', 'TransactionsController@search')->name('search');
            });
        Route::resource('/transactions', 'TransactionsController');

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
