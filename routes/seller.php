<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::group([ 'prefix' => "seller",'namespace' => 'Seller','as'=>'seller'], function () {
    Route::get('/', 'HomeController@index')->name('.landing');
    //auth
    Route::get('/login', 'AuthController@index')->name('.login');
    Route::post('/login', 'AuthController@login')->name('.login.store');
    Route::get('/home', 'HomeController@home')->name('.home');
});
