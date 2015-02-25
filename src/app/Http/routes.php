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

Route::get('/', 'WelcomeController@index');

Route::get('admin', ['middleware' => 'auth', 'uses' => 'DashboardController@index']);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);



// API
Route::get('api/issues/github',  ['middleware' => 'auth', 'uses' => 'Api\IssuesController@gitHub']);
Route::get('api/users/whoami', 'Api\UserController@whoami');
Route::get('api/caravelmessages', ['middleware' => 'auth', 'uses' => 'Api\CaravelMessagesController@index']);
