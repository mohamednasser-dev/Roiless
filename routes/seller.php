<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => "seller", 'namespace' => 'Seller', 'as' => 'seller'], function () {
    Route::get('/', 'HomeController@index')->name('.landing');
    //auth
    Route::get('/login', 'AuthController@index')->name('.login');
    Route::get('/sign_up', 'AuthController@sign_up')->name('.sign_up');
    Route::post('/sign_up/store', 'AuthController@sign_up_store')->name('.sign_up.store');

    //Forget password
    Route::get('/forget_password', 'AuthController@forget_password')->name('.forget_password');
    Route::post('/forget_password/store', 'AuthController@forget_password_store')->name('.forget_password.store');
    Route::get('/forget_password/check_code/{email}', 'AuthController@forget_password_check_code')->name('.forget_password.check_code');
    Route::post('/forget_password/check_code/store', 'AuthController@forget_password_check_code_store')->name('.forget_password.check_code.store');
    Route::get('/change_password/{email}', 'AuthController@change_password')->name('.change_password');
    Route::post('/change_password/store', 'AuthController@change_password_store')->name('.change_password.store');

    Route::get('/logout', 'AuthController@logout')->name('.logout');
    Route::post('/login/store', 'AuthController@login')->name('.login.store');

    Route::group(['middleware' => ['auth:seller','checkssl']], function () {
        Route::get('/home', 'HomeController@home')->name('.home');
        Route::group(['prefix' => 'products'], function () {
            Route::get('/', 'ProductsController@index')->name('.products');
            Route::get('/create', 'ProductsController@create')->name('.products.create');
            Route::get('/get_sub_sections/{id}', 'ProductsController@get_sub_sections')->name('.products.get_sub_sections');
            Route::post('/store', 'ProductsController@store')->name('.products.store');
            Route::get('/show/{id}', 'ProductsController@show')->name('.products.show');
            Route::get('/edit/{id}', 'ProductsController@edit')->name('.products.edit');
            Route::post('/update/{id}', 'ProductsController@update')->name('.products.update');
            Route::post('/upload/images', 'ProductsController@uploadImages')->name('.products.upload_images');
            Route::get('/delete/{id}', 'ProductsController@delete')->name('.products.delete');
            Route::get('/image_delete/{id}', 'ProductsController@image_delete')->name('.product.image.delete');
        });
        Route::group(['prefix' => 'installments','as'=>'.installments'], function () {
            Route::get('/', 'ProductsController@index');
        });
        Route::group(['prefix' => 'profile','as'=>'.profile'], function () {
            Route::get('/', 'HomeController@profile');
            Route::post('/update', 'HomeController@update_profile')->name('.update');
        });
        Route::group(['prefix' => 'orders','as'=>'.orders'], function () {
            Route::get('/', 'OrderController@index');
            Route::get('/change_status/{status}/{id}', 'OrderController@change_status')->name('.change_status');
        });

    });
});
