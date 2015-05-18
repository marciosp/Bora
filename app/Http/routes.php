<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['before' => 'auth', 'prefix' => 'api/v1'], function() {
});
    Route::get('/', 'WelcomeController@index');

	Route::get('home', 'HomeController@index');

Route::group(['prefix' => 'api/v1'], function() {

	Route::controllers([
		'auth' => 'Auth\AuthController',
		'password' => 'Auth\PasswordController',
	]);

	Route::post('users/login', 'UsersController@login');
});
