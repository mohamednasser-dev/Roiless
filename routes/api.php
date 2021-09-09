<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

        //api_token_authentication

});

Route::group(['namespace' =>'API'], function () {
    Route::post("/login","AuthController@login");

    Route::post("/update-profile","AuthController@updateProfile");

    Route::post('forgot/password','AuthController@forgot_password_post')
        ->name('admin.forgot.to.reset.password');;

    Route::get('check_token/','AuthController@reset_password');

    Route::post('reset/password/','AuthController@reset_password_post');

});
