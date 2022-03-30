<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => "seller", 'namespace' => 'Seller', 'as' => 'seller'], function () {
    Route::get('/', 'HomeController@index')->name('.landing');
    //auth
    Route::get('/login', 'AuthController@index')->name('.login');
    Route::get('/logout', 'AuthController@logout')->name('.logout');
    Route::post('/login/store', 'AuthController@login')->name('.login.store');

    Route::group(['middleware' => 'auth:seller'], function () {
        Route::get('/home', 'HomeController@home')->name('.home');
        Route::group(['prefix' => 'products'], function () {
            Route::get('/', 'ProductsController@index')->name('.products');
            Route::get('/create', 'ProductsController@create')->name('.products.create');
            Route::post('/store', 'ProductsController@store')->name('.products.store');
            Route::get('/show/{id}', 'ProductsController@show')->name('.products.show');
            Route::get('/edit/{id}', 'ProductsController@edit')->name('.products.edit');
            Route::post('/update/{id}', 'ProductsController@update')->name('.products.update');
            Route::get('/delete/{id}', 'ProductsController@delete')->name('.products.delete');
        });
        Route::group(['prefix' => 'installments'], function () {
            Route::get('/', 'ProductsController@index')->name('.installments');
        });
        Route::group(['prefix' => 'profile'], function () {
            Route::get('/', 'ProductsController@index')->name('.profile');
        });
    });
});
