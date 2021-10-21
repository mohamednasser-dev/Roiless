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
Route::group(['namespace' => 'API', 'middleware' => ['api']], function () {
//user
    Route::post("/login", "AuthController@login");

    Route::post("/Register", "AuthController@Register");
    Route::post("/loginasguest", "AuthController@loginasguest");
    Route::post('forgot/password', 'UsersController@forgot_password_post')->name('forgot.password');
    Route::post('update/forgot_password', 'UsersController@reset_password_forget');
    // setting
    Route::get('/setting', 'SettingController@index');

    Route::group(['middleware' => ['jwt.verify']], function () {
        Route::post("/logout", "AuthController@logout");
        // home page and services
        Route::get("/home", "HomeController@getall");
        Route::get("/auth/check_otp/{code}", "AuthController@check_otp");

        Route::get("/get_data_profile", "UsersController@getDataProfile");
        Route::get("/services", "ServiceController@getallservices");
        Route::get("/services_detailes/{id}", "ServiceController@getservicedetailes");
        // categories
        Route::get("/categories", "CategoryController@getall");
        // user update

        Route::get('check_token/', 'UsersController@reset_password');
        Route::post('reset/password/', 'UsersController@reset_password_post');
        Route::post("/update_password", "HomeController@updatePassword");
        // inbox
        Route::post('make/inbox', 'InboxController@store');
        // about_us
        Route::get('about_us', 'HomeController@aboutUs');
        //home page and services
        Route::get("/home", "HomeController@getall");
        Route::get("/services", "ServiceController@getallservices");
        Route::get("/services_detailes/{id}", "ServiceController@getservicedetailes");
        //categories
        Route::get("/categories", "CategoryController@getall");
        //fund detailes
        Route::get("/fund/detailes/{id}", "FundController@details");
        Route::post("/funds/addfund", "FundController@addfund");
        Route::get("/payment/{id}", "FundController@DoPayment");
        //user update
        Route::post("/update_profile", "UsersController@updateProfile");
        Route::post("/update_lang", "UsersController@updatelang");
        Route::post("/user/update_image", "UsersController@update_image");
        Route::get('check_token/', 'UsersController@reset_password');
        Route::post('reset/password/', 'UsersController@reset_password_post');
        // inbox
        Route::post('make/inbox', 'InboxController@store');
        // userFunds
        Route::get('/userfunds', 'UserfundsController@index');
        // userFundsHistory
        Route::get('/userFundsHistory/{id}', 'UserFundsHistoryController@index');
        //consolutions
        Route::get("/users/consolutions/data", "UsersController@consolutions_data");
        Route::post("/users/consolutions/store", "UsersController@consolutions_store");
        Route::get("/users/consolutions/index", "ConsolutionController@getall_consolution")->name('get.consolutions');
        Route::get("/users/consolutions/details/{id}", "ConsolutionController@getall_consolution_detailes");
        Route::post("/users/consolutions/reply", "ConsolutionController@Reply");
        Route::get("/users/consolutions/delete/{id}", "ConsolutionController@Delete");
        //notification  NotificationController
        Route::get("/get_notification", "NotificationController@getall");
    });
});
