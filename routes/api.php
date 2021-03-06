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
    //front banko
    Route::group(['prefix' => 'banko'], function () {
        Route::get("/home", "Banko\HomeController@home");
        Route::get("/funds", "Banko\HomeController@funds");
        Route::get("/slider", "Banko\HomeController@slider");
        Route::get("/investment", "Banko\HomeController@investment");
        Route::get("products_cat", "Banko\HomeController@products_cat");
        Route::get("category_child/{id}", "Banko\HomeController@category_child");
        Route::get("category/products", "Banko\HomeController@cat_pro");
        Route::get("seller/products/{id}", "Banko\HomeController@seller_products");
        Route::get("/product/details/{id}", "Banko\ProductController@details");
        Route::get("/funds/details/{id}", "Banko\HomeController@f_details");
        Route::get("/investment/details/{id}", "Banko\HomeController@i_details");
    });
//user
    Route::get("/cities", "HomeController@cities");
    Route::post("/login", "AuthController@login");
    Route::post("/Register", "AuthController@Register");
    Route::post("/loginasguest", "AuthController@loginasguest");
    Route::post("/resend_otp", "AuthController@resend_otp");

    Route::post('forgot/password', 'UsersController@forgot_password_post')->name('forgot.password');
    Route::post('update/forgot_password', 'UsersController@reset_password_forget');
    // setting
    Route::get('/setting', 'SettingController@index');
    //Payment
    Route::get("/payment/{id}/{user_id}", "FundController@DoPayment");

    //payway
    Route::post("/payment/show/phone_page/{payway}/{id}/{user_id}", "FundController@show_phone_page")->name('show_phone_page');

    Route::post("/payment/{payway}/{id}/{user_id}", "FundController@payway")->name('fawate');
    Route::get("/payment/response", "PayMobController@processedCallback")->name('response');

    Route::post("banko/order/calculate/installment", "Banko\OrderController@calculate_installment");


    //myfatoorah
    Route::post('/myfatoorah/payment/{id}/{user_id}', 'MyfatoorahController@paywith')->name('myfatoorah');
    Route::get('myfatoorah-status', 'MyfatoorahController@getPaymentStatus')->name('myfatoorah-status');
    Route::get('myfatoorah-oncomplate', 'MyfatoorahController@oncomplate')->name('myfatoorah-oncomplate');

    Route::group(['middleware' => ['jwt.verify']], function () {

        Route::group(['prefix' => 'banko'], function () {
            //Order
            Route::get("/my_orders", "Banko\OrderController@my_orders");
            Route::post("/order/create", "Banko\OrderController@make_order");
            //profile
            Route::get("/profile/get", "Banko\ProfileController@get");
            Route::post("/profile/update", "Banko\ProfileController@update");
        });

        Route::post("/logout", "AuthController@logout");
        // home page and services
        Route::get("/home", "HomeController@getall");
        Route::get("/auth/check_otp/{code}", "AuthController@check_otp");


        Route::get("/get_data_profile", "UsersController@getDataProfile");

        Route::get("/questions/index", "QuestionsController@index");
        Route::get("/questions/detailes/{id}", "QuestionsController@detailes");

        Route::get("/services", "ServiceController@getallservices");
        Route::get("/services_detailes/{id}", "ServiceController@getservicedetailes");
        // categories
        Route::get("/categories", "CategoryController@getall");
        Route::get("/category/funds/{id}", "CategoryController@category_funds");
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
        Route::get("/banks", "FundController@banks");
        Route::post("/funds/addfund", "FundController@addfund");
        Route::get("/userFund/{id}", "FundController@userFund");
        Route::post("/deletefile/{id}", "FundController@deletefile");
        Route::post("/funds/updateUserFund/{id}", "FundController@updateUserFund");
        //user update
        Route::post("/update_profile", "UsersController@updateProfile");
        Route::post("/update_city", "UsersController@update_city");
        Route::post("/update_lang", "UsersController@updatelang");
        Route::post("/user/update_image", "UsersController@update_image");
        Route::get('check_token/', 'UsersController@reset_password');
        Route::post('reset/password/', 'UsersController@reset_password_post');
        Route::post('update/password', 'UsersController@update_password');
        Route::post('generateOtp', 'UsersController@generate_otp');
        Route::post('otp_validate', 'UsersController@otp_validate');
        // inbox
        Route::post('make/inbox', 'InboxController@store');

        // user account
        Route::get('/userfunds', 'UserfundsController@index');
        Route::get('/userFundsHistory/{id}', 'UserFundsHistoryController@index');
        Route::get('/user/investments', 'InvestmentOrderController@user_investments');


        //consolutions
        Route::get("/users/consolutions/data", "UsersController@consolutions_data");
        Route::post("/users/consolutions/store", "UsersController@consolutions_store");
        Route::get("/users/consolutions/index", "ConsolutionController@getall_consolution")->name('get.consolutions');
        Route::get("/users/consolutions/details/{id}", "ConsolutionController@getall_consolution_detailes");
        Route::post("/users/consolutions/reply", "ConsolutionController@Reply");
        Route::get("/users/consolutions/delete/{id}", "ConsolutionController@Delete");
        //notification  NotificationController
        Route::get("/get_notification", "NotificationController@getall");


        //investments
        Route::get("All/Investments", "InvestmentOrderController@allInvestments");
        Route::post("investment/calculation", "InvestmentOrderController@make_calculation");
        Route::get("investment/types", "InvestmentOrderController@types");
        Route::post("Order/Investment", "InvestmentOrderController@OrderInvestment");
    });
});
