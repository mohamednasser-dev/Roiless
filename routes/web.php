<?php

use Illuminate\Support\Facades\Route;

// all type of users have appelety to view all this routes ..

//landing page
//Route::get('/', 'front\landingController@index');
Route::get('/', 'HomeController@index');

// this route for login and register
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/login_user', 'Admin\LoginController@login')->name('login_user');

