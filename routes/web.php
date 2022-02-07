<?php

use Illuminate\Support\Facades\Artisan;
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
Route::get('cache', function () {
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return 'here';
});
Route::group(['middleware' => ['auth:admin']], function() {
  Route::resource('roles','Admin\RoleController');
    Route::post('/roles/update{id}', 'Admin\RoleController@update')->name('roles.custom.update');
});

Route::get('/', 'HomeController@landing')->name('landing');

Route::group(['middleware' => 'guest', 'namespace' => 'Admin\Auth'], function () {
    Route::get('c_panel/login', 'LoginController@login')->name('login');
    Route::post('c_panel/login', 'LoginController@loginAdmin')->name('admin.login.store');
});

Route::group(['middleware' => 'auth:admin', 'namespace' => 'Admin'], function () {
    Route::get('/c_panel/home', 'DashboardController@index')->name('home');
    Route::get('/test', 'usersController@ltr');
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

});

Route::group(['middleware' => ['auth:admin']], function () {

    //users  routes
    Route::resource('users', 'Admin\usersController');
    Route::get('users/{id}/delete', 'Admin\usersController@destroy')->name('users.delete');
    Route::get('users/{id}/details', 'Admin\usersController@show')->name('users.details');
    Route::get('viewprofile/{id}', 'HomeController@viewprofile')->name('viewprofile');

    Route::get('/user/export/view', 'Admin\usersController@export_view')->name('export_view_user');
    Route::post('/user/export/view', 'Admin\usersController@export')->name('user.export.search');

    Route::post('users/actived', 'Admin\usersController@update_Actived')->name('users.actived');

    //viewprofile routes
    Route::post('employer/update', 'Admin\ProfileController@update')->name('employers.update');
    Route::post('employer/update/password', 'Admin\ProfileController@updatepassword')->name('employers.update.password');
    Route::post('employer/update/image', 'Admin\ProfileController@updateimage')->name('employers.update.image');

    //emploers  routes
    Route::resource('employer', 'Admin\employerController');
    Route::get('employer/{id}/delete', 'Admin\employerController@destroy')->name('employer.delete');
    Route::get('employer/{id}/details', 'Admin\employerController@show')->name('employer.details');
    Route::get('employer/{id}/view/log', 'Admin\employerController@showLog')->name('employer.view.log');
    Route::get('employer/view/logs', 'Admin\employerController@showLogs')->name('employer.view.logs');
    Route::post('employer/actived', 'Admin\employerController@update_Actived')->name('employer.actived');

    // change status
    Route::post('employer/change/status', 'Admin\employerController@changeStatus')->name('employer.change.status');


    //banks  routes
    Route::resource('banks', 'Admin\Bankcontroller')->middleware('permission:Banks');
    Route::get('banks/{id}/funds', 'Admin\Bankcontroller@funds')->middleware('permission:Banks')->name('banks.funds');
    Route::get('banks/create/{id}', 'Admin\Bankcontroller@create')->name('banks.create');
    Route::post('banks/store/{id}', 'Admin\Bankcontroller@store')->name('banks.store');
    Route::post('banks/update_new/{id}', 'Admin\Bankcontroller@update')->name('banks.update_new');

    Route::get('banks/{id}/delete/', 'Admin\Bankcontroller@destroy')->name('banks.delete');
    Route::get('banks/{id}/details', 'Admin\Bankcontroller@show')->name('banks.details');
    Route::get('banks/actived/{id}', 'Admin\Bankcontroller@update_Actived')->name('banks.actived');
    Route::post('banks/actived', 'Admin\Bankcontroller@unupdate_Actived')->name('banks.unactived');
    Route::get('parent_banks/actived/{id}', 'Admin\Bankcontroller@updateparent_Actived')->name('parentbanks.actived');
    Route::post('parentbanks/actived', 'Admin\Bankcontroller@unupdate_parent_pank')->name('parentbanks.unactived');
    Route::get('banks/{id}/branches', 'Admin\Bankcontroller@bankBranch')->name('banks.branches');

    Route::get('banks/branches/{id}/edit', 'Admin\Bankcontroller@editBranche')->name('banks.edit.branches');
    Route::post('banks/branches/update', 'Admin\Bankcontroller@updateBranche')->name('banks.update.branches');
    Route::get('banks/branches/{id}/delete', 'Admin\Bankcontroller@destroyBranche')->name('banks.delete.branches');
    Route::get('banks/branches/{id}/details', 'Admin\Bankcontroller@showBranche')->name('banks.details.branches');

    Route::get('banks/bankfunds/{id}', 'Admin\Bankcontroller@BankFunds')->name('funds.of.bank');
    //sliders
    Route::get('/sliders', 'Admin\sliderController@index')->name('sliders');
    Route::get('sliders/create', 'Admin\sliderController@create')->name('sliders.add');
    Route::post('/sliders/store', 'Admin\sliderController@store')->name('sliders.store');
    Route::get('/sliders/edit/{id}', 'Admin\sliderController@edit')->name('sliders.edit');
    Route::put('/sliders/update/{id}', 'Admin\sliderController@update')->name('sliders.update');
    Route::get('/sliders/delete/{id}', 'Admin\sliderController@destroy')->name('slidersbanks.funds.delete');

    //categories
    Route::get('/categories', 'Admin\categoriesController@index')->name('categories');
    Route::get('categories/create', 'Admin\categoriesController@create')->name('categories.add');
    Route::post('/categories/store', 'Admin\categoriesController@store')->name('categories.store');
    Route::get('/categories/edit/{id}', 'Admin\categoriesController@edit')->name('categories.edit');
    Route::put('/categories/update/{id}', 'Admin\categoriesController@update')->name('categories.update');
    Route::get('/categories/delete/{id}', 'Admin\categoriesController@destroy')->name('categories.delete');

    // services

    Route::group(['namespace' => 'Admin'], function () {
        Route::get('/services', 'ServiceController@index')->name('services');
        Route::get('services/create', 'ServiceController@create')->name('services.add');
        Route::post('/services/store', 'ServiceController@store')->name('services.store');
        Route::get('/services/edit/{id}', 'ServiceController@edit')->name('services.edit');
        Route::post('/services/update/{id}', 'ServiceController@update')->name('services.update');
        Route::get('/services/delete/{id}', 'ServiceController@destroy')->name('services.delete');

        // services details

        Route::get('/services/details/{id}', 'ServiceController@details')->name('services.details');
        Route::get('/services/create_serv_detail/{id}', 'ServiceController@detcreate')->name('services.details.create');
        Route::post('/services/store_serv_detail', 'ServiceController@detstore')->name('services.details.store');
        Route::get('/services/store_serv_detail/{id}', 'ServiceController@detedit')->name('services.details.edit');
        Route::post('/services/store_serv_update/{id}', 'ServiceController@detupdate')->name('services.details.update');
        Route::get('/services/deletes_serv_detail/{id}', 'ServiceController@detdestroy')->name('services.details.delete');

    });
    //notifications
    Route::group(['namespace' => 'Admin'], function () {
        Route::resource('/notifications', 'NotificationsController');
        Route::post('/notifications/update/{id}', 'NotificationsController@update')->name('notifications.update');
        Route::get('/notifications/delete/{id}', 'NotificationsController@destroy')->name('notification.delete');
    });
    // Setting

    Route::group(['namespace' => 'Admin'], function () {
        Route::get('/Setting/edit', 'SettingController@edit')->name('Setting.edit');
        Route::post('/Setting/update/{id}', 'SettingController@update')->name('Setting.update');
        Route::get('/Setting/delete/adress/{id}', 'SettingController@delete')->name('Setting.delete.adress');

    });

    // questios

    Route::group(['namespace' => 'Admin'], function () {
        Route::get('/question', 'QuestionController@index')->name('question');
        Route::get('question/create', 'QuestionController@create')->name('question.add');
        Route::post('/question/store', 'QuestionController@store')->name('question.store');
        Route::get('/question/edit/{id}', 'QuestionController@edit')->name('question.edit');
        Route::get('/question/show/{id}', 'QuestionController@show')->name('question.show');
        Route::post('/question/update/{id}', 'QuestionController@update')->name('question.update');
        Route::get('/question/delete/{id}', 'QuestionController@destroy')->name('question.delete');
    });


    // funds

    Route::group(['namespace' => 'Admin'], function () {
        Route::get('/fund', 'fundController@index')->name('fund');
        Route::get('fund/create', 'fundController@create')->name('fund.create');
        Route::post('/fund/store', 'fundController@store')->name('fund.store');
        Route::get('/fund/details/{id}', 'fundController@details')->name('fund.details');
        Route::get('/fund/edit/{id}', 'fundController@edit')->name('fund.edit');
        Route::post('/fund/update/{id}', 'fundController@update')->name('fund.update');
        Route::get('/fund/delete/{id}', 'fundController@destroy')->name('fund.delete');
        Route::post('/fund/change/featured', 'fundController@changeStatus')->name('fund.change.featured');
        Route::post('/fund/change/appearance', 'fundController@appearance')->name('fund.change.appearance');

    });
    // inbox
    Route::group(['namespace' => 'Admin'], function () {
        Route::get('/inbox', 'InboxController@index')->name('inbox');
        Route::get('/inbox/delete/{id}', 'InboxController@destroy')->name('inbox.delete');
    });

    // userfunds
    Route::group(['namespace' => 'Admin'], function () {
        Route::get('/funds/requests', 'UserfundsController@index')->name('userfunds');
       Route::get('/funds/requests/employer/chosen/{id}/{type}', 'UserfundsController@employerchosen')->name('employerchosen');
       Route::get('/funds/requests/fund/request/review/{id}/{type}', 'UserfundsController@review')->name('review');
       Route::get('/funds/export/view', 'UserfundsController@export_view')->name('export_view');
       Route::get('/funds/view/{id}', 'UserfundsController@view')->name('view');
       Route::get('/funds/download/{id}', 'UserfundsController@download')->name('download');
       Route::post('/funds/export/view', 'UserfundsController@export')->name('userfunds.export.search');
       Route::post('/fund/redirect/emp/{id}', 'UserfundsController@redirect_emp')->name('fund.redirect.emp');
       Route::post('/fund/redirect/bank/{id}', 'UserfundsController@redirect_bank')->name('fund.redirect.bank');
       Route::post('/fund/redirect/user/{id}/{type}', 'UserfundsController@redirect_user')->name('fund.redirect.user');
    });

    //consolution
    Route::group(['namespace' => 'Admin'], function () {
        Route::get('/consolutions', 'ConsolutionController@index')->name('consolutions');
        Route::get('/consolutions/show/{id}', 'ConsolutionController@show')->name('consolutions.show');
        Route::post('/consolutions/admin/reply', 'ConsolutionController@admin_reply')->name('admin.reply');
        Route::get("/users/consolutions/delete/{id}", "ConsolutionController@Delete")->name('delete');
    });
    //consolutionKind
    Route::group(['namespace' => 'Admin'], function () {
        Route::get('/consolutionKind', 'ConsolutionKindControler@index')->name('consolutionKind');
        Route::get('consolutionKind/create', 'ConsolutionKindControler@create')->name('consolutionKind.create');
        Route::post('/consolutionKind/store', 'ConsolutionKindControler@store')->name('consolutionKind.store');
        Route::get('/consolutionKind/edit/{id}', 'ConsolutionKindControler@edit')->name('consolutionKind.edit');
        Route::post('/consolutionKind/update/{id}', 'ConsolutionKindControler@update')->name('consolutionKind.update');
        Route::get('/consolutionKind/delete/{id}', 'ConsolutionKindControler@destroy')->name('consolutionKind.delete');
    });
    // export data

    Route::get('export', 'ImportExportController@export')->name('export');
    Route::get('export/user_fund', 'ImportExportController@export_userfund')->name('export_userfund');

    // investmentType
    Route::group(['namespace' => 'Admin'], function () {
        Route::get('/investmentType', 'InvestmentTypeController@index')->name('investmentType');
        Route::get('/investmentType/create', 'InvestmentTypeController@create')->name('investmentType.create');
        Route::post('/investmentType/store', 'InvestmentTypeController@store')->name('investmentType.store');
        Route::get('/investmentType/edit/{id}', 'InvestmentTypeController@edit')->name('investmentType.edit');
        Route::post('/investmentType/update/{id}', 'InvestmentTypeController@update')->name('investmentType.update');
        Route::get('/investmentType/delete/{id}', 'InvestmentTypeController@delete')->name('investmentType.delete');
    });
    // investment
    Route::group(['namespace' => 'Admin'], function () {
        Route::get('/investment', 'InvestmentController@index')->name('investment');
        Route::get('/investment/create', 'InvestmentController@create')->name('investment.create');
        Route::post('/investment/store', 'InvestmentController@store')->name('investment.store');
        Route::get('/investment/edit/{id}', 'InvestmentController@edit')->name('investment.edit');
        Route::post('/investment/update/{id}', 'InvestmentController@update')->name('investment.update');
        Route::get('/investment/delete/{id}', 'InvestmentController@delete')->name('investment.delete');
    });

    // investment order
    Route::group(['namespace' => 'Admin'], function () {
        Route::get('order/Investment/all', 'InvestmentOrderController@index')->name('investments.orders');
        Route::get('order/Investment/{id}', 'InvestmentOrderController@view')->name('investments.order.view');
    });
});

Route::get('change_lang/{lang}', 'HomeController@change_lang')->name('change_lang');
