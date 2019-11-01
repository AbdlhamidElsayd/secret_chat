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



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ],
    function()
    {
        Route::get('/','HomeController@home')->name('home');

        //user-details
        Route::PUT('/change-photo','UserController@change_photo')->name('change_photo');
        Route::PUT('/change_details','UserController@change_details')->name('change_details');
        Route::post('/changePassword','UserController@changePassword')->name('changePassword');



        Route::get('/registeruser','HomeController@regesteruser')->name('registeruser');
        Route::get('/search','HomeController@search')->name('search');
        Route::post('/start-chat','HomeController@start_chat')->name('start_chat')->middleware('auth');
        Route::get('/chat','HomeController@chat')->name('chat')->middleware('auth');

        Route::post('registeruser', 'UserController@register')->name('register_home');
        Route::group(['prefix' => 'dashboard' , 'middlware'=>'auth'], function () {
            Route::get('/', 'HomeController@dashboard')->name('dashboard');
            Route::get('/index','SettingController@index')->name('index');
            Route::get('/editsetting','SettingController@edit')->name('edit_setting');
            Route::put('/update/{id}','SettingController@update')->name('setting.update');
            Route::get('/messages','HomeController@messages')->name('messages');

        });	
        Route::get('images/{filename?}', 'HomeController@image_show')->name('image_show');

        Route::get('dashboard/', 'HomeController@dashboard')->name('dashboard');

        Auth::routes();
       
        Route::get('images/{filename?}', 'HomeController@image_show')->name('image_show');
        
    });
