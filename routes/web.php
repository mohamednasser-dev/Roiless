<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();



Route::post('/login_user', 'Admin\LoginController@login')->name('login_user');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    //users  routes
    Route::resource('users', 'Admin\usersController');
    Route::get('users/{id}/delete', 'Admin\usersController@destroy')->name('users.delete');
    Route::get('users/{id}/details', 'Admin\usersController@show')->name('users.details');
    Route::post('users/actived', 'Admin\usersController@update_Actived')->name('users.actived');


 //services  routes
    Route::resource('services', 'ServiceController');
//    Route::get('services', 'ServiceController@index')->name('services.index');
    Route::get('services/delete/{id}', 'ServiceController@destroy')->name('services.delete');
//    Route::get('services/{id}/details', 'ServiceController@show')->name('services.details');
//    Route::post('services/actived', 'ServiceController@update_Actived')->name('services.actived');

});
