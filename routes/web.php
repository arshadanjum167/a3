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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/','DefaultController@index')->name('web_home');

//cms pages
Route::get('about','DefaultController@showabout')->name('show_about');
Route::get('contactus','DefaultController@showcontactus')->name('show_contactus');
Route::get('blog','DefaultController@bloglist')->name('show_blog_list');

Route::get('blog/{slug}','DefaultController@showblog')->name('show_blog');
