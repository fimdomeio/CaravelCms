<?php
//namespace Fimdomeio\Caravel;

Route::get('admin', function()
{
	return View::make('caravel::admin.dashboard');
});

Route::resource('boats', '\Fimdomeio\Caravel\BoatsController');

/*** Auth controllers ***/
Route::get('login', '\Fimdomeio\Caravel\AuthController@showlogin');
Route::post('login', '\Fimdomeio\Caravel\AuthController@dologin');
Route::get('logout', '\Fimdomeio\Caravel\AuthController@logout');
Route::get('register', '\Fimdomeio\Caravel\AuthController@register');
Route::post('register', '\Fimdomeio\Caravel\AuthController@store');