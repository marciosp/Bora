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
	//Users
	Route::post('users', 'UsersController@store');
	Route::get('users/{permalink}', 'UsersController@show');

	//Companies
	Route::get('companies/{permalink}', 'CompaniesController@show');
});

Route::group(['middleware' => 'auth.token', 'prefix' => 'api/v1'], function() {
	//Users
	Route::put('users/{id}', 'UsersController@update');

	//Companies
	Route::post('companies', 'CompaniesController@store');
	Route::put('companies/{id}', 'CompaniesController@update');
});
