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

//Route::get('admin', array('middleware' => 'auth', 'uses' => 'DashboardController@index'));

Route::get('admin/generator', array('middleware' => 'auth', 'uses' => 'GeneratorController@index'));
Route::controllers(array(
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
));

//OAUTH2
Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});


// API
Route::get('api/issues/github',  array('middleware' => 'auth', 'uses' => 'Api\IssuesController@gitHub'));
Route::get('api/users/me', 'Api\UserController@me');
Route::get('api/caravelmessages', array('middleware' => 'auth', 'uses' => 'Api\CaravelMessagesController@index'));
