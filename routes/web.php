<?php

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
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/products', 'HomeController@products')->name('products');

Route::get('/cart', 'HomeController@cart')->middleware(['auth'])->name('cart');

Route::get('/product/{id}', 'HomeController@product')->name('product');

// cart routes ajax
// add product
Route::post('carts/add', 'Dashboard\CartController@store')->name('carts.add');
// update product
Route::put('carts/update', 'Dashboard\CartController@update')->name('carts.update');
// delete product
Route::delete('carts/delete', 'Dashboard\CartController@destroy')->name('carts.delete');
// confirm cart
Route::post('carts/confirm', 'Dashboard\CartController@confirm')->name('carts.confirm');
