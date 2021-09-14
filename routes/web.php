
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

// Auth::routes();



 // Route::post('/login_user', 'Admin\LoginController@login')->name('login_user');

Route::group( [ 'middleware'=> 'guest:admin' , 'namespace'=> 'Admin\Auth' ] , function () {
    Route::get('/login', 'LoginController@login')->name('admin.login');
    Route::post('/login-store', 'LoginController@loginBank')->name('admin.login.store');
});

Route::group( [ 'middleware'=> 'auth:admin' , 'namespace'=> 'Admin' ] , function () {
    Route::get('/', 'DashboardController@index')->name('home');

    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

});

Route::group(['middleware' => ['auth']], function () {


    //users  routes
    Route::resource('users', 'Admin\usersController');
    Route::get('users/{id}/delete', 'Admin\usersController@destroy')->name('users.delete');
    Route::get('users/{id}/details', 'Admin\usersController@show')->name('users.details');
    Route::post('users/actived', 'Admin\usersController@update_Actived')->name('users.actived');


    //emploers  routes
    Route::resource('employer', 'Admin\employerController');
    Route::get('employer/{id}/delete', 'Admin\employerController@destroy')->name('employer.delete');
    Route::get('employer/{id}/details', 'Admin\employerController@show')->name('employer.details');
    Route::post('employer/actived', 'Admin\employerController@update_Actived')->name('employer.actived');

    // change status
    Route::post('employer/change/status', 'Admin\employerController@changeStatus')->name('employer.change.status');


    //banks  routes
    Route::resource('banks', 'Admin\Bankcontroller');
    Route::get('banks/{id}/delete', 'Admin\Bankcontroller@destroy')->name('banks.delete');
    Route::get('banks/{id}/details', 'Admin\Bankcontroller@show')->name('banks.details');
    Route::post('banks/actived', 'Admin\Bankcontroller@update_Actived')->name('banks.actived');

    //sliders
    Route::get('/sliders', 'Admin\sliderController@index')->name('sliders');
    Route::get('sliders/create','Admin\sliderController@create')->name('sliders.add');
    Route::post('/sliders/store','Admin\sliderController@store')->name('sliders.store');
    Route::get('/sliders/edit/{id}','Admin\sliderController@edit')->name('sliders.edit');
    Route::put('/sliders/update/{id}','Admin\sliderController@update')->name('sliders.update');
    Route::get('/sliders/delete/{id}','Admin\sliderController@destroy')->name('sliders.delete');


    //categories
        Route::get('/categories', 'Admin\categoriesController@index')->name('categories');
        Route::get('categories/create','Admin\categoriesController@create')->name('categories.add');
        Route::post('/categories/store','Admin\categoriesController@store')->name('categories.store');
        Route::get('/categories/edit/{id}','Admin\categoriesController@edit')->name('categories.edit');
        Route::put('/categories/update/{id}','Admin\categoriesController@update')->name('categories.update');
        Route::get('/categories/delete/{id}','Admin\categoriesController@destroy')->name('categories.delete');

    // services

    Route::group(['namespace' =>'Admin'], function () {
        Route::get('/services', 'ServiceController@index')->name('services');
        Route::get('services/create','ServiceController@create')->name('services.add');
        Route::post('/services/store','ServiceController@store')->name('services.store');
        Route::get('/services/edit/{id}','ServiceController@edit')->name('services.edit');
        Route::post('/services/update/{id}','ServiceController@update')->name('services.update');
        Route::get('/services/delete/{id}','ServiceController@destroy')->name('services.delete');

        // services details

        Route::get('/services/details/{id}','ServiceController@details')->name('services.details');
        Route::get('/services/create_serv_detail/{id}','ServiceController@detcreate')->name('services.details.create');
        Route::post('/services/store_serv_detail','ServiceController@detstore')->name('services.details.store');
        Route::get('/services/store_serv_detail/{id}','ServiceController@detedit')->name('services.details.edit');
        Route::post('/services/store_serv_update/{id}','ServiceController@detupdate')->name('services.details.update');
        Route::get('/services/deletes_serv_detail/{id}','ServiceController@detdestroy')->name('services.details.delete');

    });
    //notifications
    Route::group(['namespace' =>'Admin'], function () {
        Route::resource('/notifications','NotificationsController');
    });
    // Setting

    Route::group(['namespace' =>'Admin'], function () {
        Route::get('/Setting/edit','SettingController@edit')->name('Setting.edit');
        Route::post('/Setting/update/{id}','SettingController@update')->name('Setting.update');
    });

  // questios

    Route::group(['namespace' =>'Admin'], function () {
        Route::get('/question', 'QuestionController@index')->name('question');
        Route::get('question/create','QuestionController@create')->name('question.add');
        Route::post('/question/store','QuestionController@store')->name('question.store');
        Route::get('/question/edit/{id}','QuestionController@edit')->name('question.edit');
        Route::post('/question/update/{id}','QuestionController@update')->name('question.update');
        Route::get('/question/delete/{id}','QuestionController@destroy')->name('question.delete');
    });


  // funds

    Route::group(['namespace' =>'Admin'], function () {
        Route::get('/fund', 'fundController@index')->name('fund');
        Route::get('fund/create','fundController@create')->name('fund.create');
        Route::post('/fund/store','fundController@store')->name('fund.store');
        Route::get('/fund/details/{id}','fundController@details')->name('fund.details');
        Route::get('/fund/edit/{id}','fundController@edit')->name('fund.edit');
        Route::post('/fund/update/{id}','fundController@update')->name('fund.update');
        Route::get('/fund/delete/{id}','fundController@destroy')->name('fund.delete');
        Route::post('/fund/change/featured', 'fundController@changeStatus')->name('fund.change.featured');
    });
    // inbox
  Route::group(['namespace' =>'Admin'], function () {
        Route::get('/inbox', 'InboxController@index')->name('inbox');
        Route::get('/inbox/delete/{id}','InboxController@destroy')->name('inbox.delete');
    });


});
