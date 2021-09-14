<?php

use Illuminate\Support\Facades\Route;


Route::group( [ 'middleware'=> 'guest:bank' , 'namespace'=> 'Bank\Auth' ] , function () {
    Route::get('/login', 'LoginController@login')->name('bank.login');
    Route::post('/login-store', 'LoginController@loginBank')->name('bank.login.store');
});

Route::group(['middleware'=> 'auth:bank', 'namespace'=> 'Bank' ], function () {
    Route::get('/home', 'DashboardController@homeBank')->name('bank.home');

    Route::post('/logout', 'Auth\LoginController@logout')->name('bank.logout');


});
