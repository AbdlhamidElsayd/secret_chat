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
        
        Route::group([ 'middlware'=>'auth'], function () {

            //user-details
            Route::PUT('/change-photo','UserController@change_photo')->name('change_photo');
            Route::PUT('/change_details','UserController@change_details')->name('change_details');
            Route::post('/changePassword','UserController@changePassword')->name('changePassword');
           
            //chat
            Route::post('/start-chat','HomeController@start_chat')->name('start_chat');
            Route::get('/chat','HomeController@chat')->name('chat');
            Route::post('/chat/send-message', 'HomeController@send_message')->name('send_message');
            Route::post('/chat/messages', 'HomeController@get_chat_messages')->name('get_chat_messages');
            Route::get('/messages','HomeController@messages')->name('messages');
            Route::get('/search','HomeController@search')->name('search');
            Route::get('/nearest','HomeController@nearest')->name('nearest');
            Route::post('/nearest','HomeController@nearest_post');
        });	


        Route::group(['prefix' => 'dashboard' , 'middlware'=>'auth'], function () {
            Route::get('/', 'HomeController@dashboard')->name('dashboard');
            Route::get('/index','SettingController@index')->name('index');
            Route::get('/editsetting','SettingController@edit')->name('edit_setting');
            Route::put('/update/{id}','SettingController@update')->name('setting.update');
            

        });	
        Route::get('images/{filename?}', 'HomeController@image_show')->name('image_show');


        Auth::routes();
        Route::get('registeruser', 'UserController@regesteruser')->name('registeruser');
        Route::post('registeruser', 'UserController@register')->name('register_home');
       
        
    });
