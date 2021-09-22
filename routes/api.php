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
    Route::group(['middleware' => ['jwt.verify']], function () {
        Route::post("/logout", "AuthController@logout");
        // home page and services
        Route::get("/home", "HomeController@getall");
        Route::get("/services", "ServiceController@getallservices");
        Route::get("/services_detailes/{id}", "ServiceController@getservicedetailes");
        // categories
        Route::get("/categories", "CategoryController@getall");
        // user update
        Route::post("/update-profile/{id}", "UsersController@updateProfile");
        Route::post('forgot/password', 'UsersController@forgot_password_post')->name('admin.forgot.to.reset.password');;
        Route::get('check_token/', 'UsersController@reset_password');
        Route::post('reset/password/', 'UsersController@reset_password_post');
        Route::post("/update-password", "HomeController@updatePassword");
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
        Route::get("/fund/detailes/{id}", "FundController@getfunddetailes");
        Route::post("/addfund", "FundController@addfund");

//user update
        Route::post("/update-profile/{id}", "UsersController@updateProfile");
        Route::post('forgot/password', 'UsersController@forgot_password_post')
            ->name('admin.forgot.to.reset.password');;
        Route::get('check_token/', 'UsersController@reset_password');
        Route::post('reset/password/', 'UsersController@reset_password_post');

        // inbox
        Route::post('make/inbox', 'InboxController@store');
        // setting
        Route::get('/setting', 'SettingController@index');
        // userFunds
        Route::get('/userfunds', 'UserfundsController@index');

        // userFundsHistory
        Route::get('/userFundsHistory', 'UserFundsHistoryController@index');

    });


});
