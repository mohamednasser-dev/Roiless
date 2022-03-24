<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::group([ 'prefix' => "seller",'namespace' => 'Seller','as'=>'seller'], function () {
    Route::get('/', 'HomeController@index')->name('.landing');
    Route::get('/login', 'AuthController@index')->name('.landing');
    Route::get('/home', 'HomeController@home')->name('.home');
});
