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
Auth::routes();

Route::get('email/resendVerification', ['as' => 'resend.emailVerify', 'uses' => 'Auth\RegisterController@resendActivationEmail']);

Route::group(['middleware' => 'notBanned'], function() {

    Route::resource('post', 'PostController', ['only' => ['show']]);
    Route::get('/', ['uses' => 'PostController@index', 'as' => 'post.index']);
    Route::get('posts', ['uses' => 'PostController@search', 'as' => 'post.search']);

    Route::get('register/confirm/{token}', [
        'uses' => 'Auth\RegisterController@activate',
        'as'   => 'register.activate',
    ]);

    Route::get('/home', 'HomeController@index');

    Route::get('admin/register', [
        'uses'  =>'Admin\RegisterAdminController@showRegistrationForm', 
        'roles' => 'admin',
    ]);

    Route::post('admin/register', [
        'uses'  =>'Admin\RegisterAdminController@register', 
        'roles' => 'admin'
    ]);

    Route::get('cabinet', ['uses' => 'CabinetController@index', 'as' => 'cabinet.index']);

    Route::put('cabinet/edit', [
        'uses' => 'CabinetController@update',
        'as'   => 'cabinet.edit',

    ]);

    Route::group(['roles' => 'Admin', 'namespace' => 'Admin'], function() {
        Route::resource('admin', 'AdminController');
        Route::resource('categories', 'CategoryController', ['except' => ['create', 'show']]);
        Route::resource('tags', 'TagController', ['except' => ['create', 'show']]);
        Route::get('user/{user}/role', ['uses' => 'RoleController@showAssigningForm', 'as' => 'role.assign.show']);
        Route::patch('role/assign', ['uses' => 'RoleController@assign', 'as' => 'role.assign']);
        Route::get('trash', ['uses' => 'AdminController@trash', 'as' => 'admin.trash']);
    });

    Route::get('tag/{tag}', [
        'uses' => 'PostController@showPostsByTag',
        'as'   => 'tag.show'
    ]);

    Route::get('category/{category}', [
        'uses' => 'PostController@showPostsByCategory',
        'as'   => 'category.show'
    ]);

    Route::resource('comment', 'CommentController', ['except' => ['create', 'show', 'index']]);

    Route::post('comment/{comment}/rateup', ['uses' => 'CommentController@rateUp', 'as' => 'comment.rateup']);
    Route::post('comment/{comment}/ratedown', ['uses' => 'CommentController@rateDown', 'as' => 'comment.ratedown']);

    Route::group(['middleware' => 'auth'], function() {
        Route::post('post/{post}/rateup', ['uses' => 'PostController@rateUp', 'as' => 'post.rateup']);
        Route::post('post/{post}/ratedown', ['uses' => 'PostController@rateDown', 'as' => 'post.ratedown']);
        Route::get('subscribes', ['uses' => 'PostController@showPostsBySubscribes', 'as' => 'post.subscribes']);
    });

    Route::post('password/change', ['as' => 'password.change', 'uses' => 'CabinetController@changePassword']);
    Route::post('email/change', ['as' => 'email.change', 'uses' => 'CabinetController@sendResetEmailLink']);
    Route::get('email/change/{token}', ['as' => 'email.token', 'uses' => 'CabinetController@confirmChangeEmail']);
    Route::post('email/update', ['as' => 'email.update', 'uses' => 'CabinetController@changeEmail']);
    Route::get('user/{username}', ['as' => 'user.show', 'uses' => 'UserController@show']);
    Route::get('cabinet/subscribes', ['as' => 'cabinet.subscribes', 'uses' => 'CabinetController@showSubscribeSettings']);
    Route::post('cabinet/subscribes', ['as' => 'cabinet.updateTags', 'uses' => 'CabinetController@updateTags']);

    Route::group(['roles' => ['Admin', 'Moderator']], function() {
        Route::resource('ban', 'BanController', ['except' => ['create', 'edit', 'update']]);
        Route::get('ban/{ban}/create', ['uses' => 'BanController@create', 'as' => 'ban.create']);
    });

});


Route::get('banned', [
    'uses'       => 'UserController@showBannedMessage', 
    'as'         => 'banned',
    'middleware' => ['auth', 'banned'],
]);