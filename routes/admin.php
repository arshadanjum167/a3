<?php

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

// Route::get('/','Admin\DashboardController@index')->name('admin_home')->middleware('disablepreventback','admin_auth');

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'as'=>'admin.'

], function ($router) {

  $router->group([
      'middleware' => 'admin_guest',
      'namespace'=>'Auth'
  ], function ($router) {

    // authentication related routes
    Route::get('login','LoginController@showLoginForm')->name('login_form');
    Route::post('login','LoginController@login')->name('login');

    // Password Reset Routes...
    Route::get('password/reset','ForgotPasswordController@showLinkRequestForm')->name('show_forgot_form');
    Route::post('password/email','ForgotPasswordController@sendResetLinkEmail')->name('forgot_password');

    Route::get('password/reset/{token}','ResetPasswordController@showResetForm')->name('show_reset_form');
    Route::post('password/reset','ResetPasswordController@reset')->name('reset_password');

  });


  $router->group([
    'middleware' => ['disablepreventback','admin_auth'], // Custom auth middleware
  ], function ($router) {

    //dashboard
    Route::get('/','DashboardController@index')->name('dashboard.home');
    Route::get('dashboard','DashboardController@index')->name('dashboard.index');



    Route::post('logout','Auth\LoginController@logout')->name('logout');
    // Route::get('/','HomeController')->name('home');

    Route::get('change-password','Profile\ChangePasswordController@showChangePasswordForm')->name('show_change_password_form');
    Route::post('change-password','Profile\ChangePasswordController@changePassword')->name('change_password');
    Route::get('checkpassword','Profile\ChangePasswordController@checkOldPassword')->name('checkoldpassword');

    Route::get('my-profile','Profile\MyProfileController@showProfile')->name('show_profile');
    Route::get('edit-profile','Profile\MyProfileController@showEditProfileForm')->name('show_edit_profile_form');
    Route::post('edit-profile','Profile\MyProfileController@editProfile')->name('edit_profile_form');

    

    // for email templates
    $router->resource('emailtemplates','EmailtemplateController',[
      'parameters'=>[
        'emailtemplates'=>'id',
      ],
    ]);

    //  for cms pages
    $router->resource('cmspages','CmspageController',[
      'parameters'=>[
          'cmspages'=>'id',
      ],
    ]);

    Route::get('project/status_change', 'ProjectController@statusChange')->name('project.status_change');
    $router->resource('project','ProjectController',[
      'parameters'=>[
          'project'=>'id',
      ],
    ]);
    
  });

});
