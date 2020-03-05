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

Route::match(['get', 'post'], '/', function() {
	return view('welcome');
});

Route::match(['get', 'post'],'chat', 'ChatController@checkExistUser')->name('chat');

Route::match(['get','post'],'logout', 'ChatController@logoutUser')->name('logout');

// Route::post($uri, $callback);
