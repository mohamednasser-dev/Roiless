<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::group([ 'prefix' => "seller",'namespace' => 'Seller','as'=>'seller'], function () {
    Route::get('/', 'HomeController@index')->name('.landing');
    //auth
    Route::get('/login', 'AuthController@index')->name('.login');
    Route::get('/logout', 'AuthController@logout')->name('.logout');
    Route::post('/login/store', 'AuthController@login')->name('.login.store');
    Route::get('/home', 'HomeController@home')->name('.home');
    Route::get('/products', 'HomeController@products')->name('.products');
});
