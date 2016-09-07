<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::resource('post', 'PostController');

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('hook', [
	'uses' =>'PostController@test', 
	'as' => 'test',
	// 'middleware' => 'roles',
	// 'roles' => 'admin'
]);
;