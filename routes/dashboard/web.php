<?php

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

    Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

        Route::get('/', 'WelcomeController@index')->name('welcome');

        // category routes
        Route::resource('categories', 'CategoryController')->except(['show']);

        // supplier routes
        Route::resource('suppliers', 'SupplierController')->except(['show']);

        // product routes
        Route::resource('products', 'ProductController')->except(['show']);

        // client routes
        Route::resource('clients', 'ClientController')->except(['show']);
        Route::resource('clients.orders', 'Client\OrderController');

        // order routes
        Route::resource('orders', 'OrderController');
        Route::get('orders/{order}/products', 'OrderController@products')->name('orders.products');
        // confirm cart
        Route::post('orders/confirm', 'OrderController@confirm')->name('order.confirm');


        // user routes
        Route::resource('users', 'UserController')->except(['show']);

    });//end of dashboard routes
});


