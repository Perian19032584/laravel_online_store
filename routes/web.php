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

Auth::routes([
    'reset' => false,
    'confirm' => false,
    'verify' => false,

]);

Route::get('/logout', "Auth\LoginController@logout")->name('get_logout');

Route::middleware(['auth'])->group(function (){

    Route::group(['prefix' => 'person', 'namespace' => 'Person', 'as' => 'person.'], function (){
        Route::get('/orders', 'OrderController@home')->name('orders.home');
        Route::get('/show/{order}', 'OrderController@show')->name('orders.show');
    });

    Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function (){//админка
        Route::group(['middleware' => 'is_admin'], function (){
            Route::get('/orders', 'OrderController@home')->name('home');
            Route::get('/show/{order}', 'OrderController@show')->name('orders.show');
        });

        Route::resource('categories', 'CategoryController');
        Route::resource('product', 'ProductController');

    });
});

Route::get('/', "MainController@home")->name('home2');
Route::get('/categories', 'MainController@categories')->name('categories');
Route::post('/basket/add/{id}', 'BasketController@basket_add')->name('basket_add');

Route::group(['middleware' => 'basket_not_empty'], function (){
    Route::get('/basket', 'BasketController@basket')->name('basket');
    Route::post('/basket/remove/{id}', 'BasketController@basket_remove')->name('basket_remove');
    Route::get('/basket/place', 'BasketController@order')->name('order');
    Route::post('/basket/confirm', 'BasketController@confirm')->name('confirm');
});

Route::get('{category}', 'MainController@category')->name('category');
Route::get('/{category}/{product?}', 'MainController@product')->name('product');


