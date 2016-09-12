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

Auth::routes();

Route::get('register/comfirm/{token}', [
    'uses' => 'Auth\RegisterController@activate',
    'as'   => 'register.activate',
]);

Route::get('/home', 'HomeController@index');
Route::get('hook', [
    'uses' =>'PostController@test', 
    'as' => 'test',
    // 'middleware' => 'roles',
    // 'roles' => 'admin'
]);

Route::get('admin/register', [
    'uses' =>'Admin\RegisterAdminController@showRegistrationForm', 
    'roles' => 'admin',
]);
Route::post('admin/register', [
	'uses' =>'Admin\RegisterAdminController@register', 
	'roles' => 'admin'
]);

Route::get('cabinet', [
	'uses' => 'CabinetController@index',
]);

Route::put('cabinet/edit', [
	'uses' => 'CabinetController@update',
]);