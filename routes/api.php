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



Route::group(['namespace' =>'API','middleware'=>['api']], function () {
    /************************user********************* */
    Route::post("/login","AuthController@login");
    Route::post("/Register","AuthController@Register");
    Route::post("/loginasguest","AuthController@loginasguest");
    Route::post("/logout","AuthController@logout")->middleware('jwt.verify');
    /********************************************* */


    /*******************home page and services*********************/
    Route::get("/home","HomeController@getall");
    Route::get("/services","ServiceController@getallservices");
    Route::get("/services_detailes/{id}","ServiceController@getservicedetailes");
    /*************************************************************/


    Route::post("/update-profile/{id}","UsersController@updateProfile")->middleware('jwt.verify');
    Route::post('forgot/password','UsersController@forgot_password_post')
        ->name('admin.forgot.to.reset.password');;
    Route::get('check_token/','UsersController@reset_password');
    Route::post('reset/password/','UsersController@reset_password_post');

});
