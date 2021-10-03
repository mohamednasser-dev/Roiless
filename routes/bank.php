<?php

use Illuminate\Support\Facades\Route;


Route::group( [ 'middleware'=> 'guest' , 'namespace'=> 'Bank\Auth' ] , function () {
    Route::get('/login', 'LoginController@login')->name('bank.login');
    Route::post('/login-store', 'LoginController@loginBank')->name('bank.login.store');
});

Route::group(['middleware'=> 'auth:bank', 'namespace'=> 'Bank' ], function () {
    Route::get('/home', 'DashboardController@homeBank')->name('bank.home');
    Route::post('/logout', 'Auth\LoginController@logout')->name('bank.logout');
    Route::get('/funds', 'FundController@getFund')->name('bank.get.fund');

// userfunds
    Route::get('/Requests', 'UserfundsController@index')->name('funds.request');
    Route::get('/view_details/{id}', 'UserfundsController@details')->name('request.review');
    Route::post('/request_rejected/{id}', 'UserfundsController@redirectEmployer')->name('request.rejected');



});

