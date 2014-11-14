<?php

//namespace Fimdomeio\Caravel;

Route::get('/', function()
	{
		$title = 'Home';
		return View::make('home')
			->with('title', $title);
	});

Route::get('admin', array(
	'before' => 'auth',
	function()
		{
			$title = 'Dashboard';
			return View::make('admin.dashboard')
				->with('title', $title);
		}
	));
Route::group(array('before'=>'auth'), function() {   
	Route::resource('boats', 'BoatsController');
});

	/**
	 * Auth controllers
	 *
	 * Only logout Route is available to authenticated users,
	 * the rest is guest only for security reasons.
	 */
Route::get('login', array(
	'before' => 'guest',
	'as' => 'auth.login.show',
	'uses' => '\AuthController@showLogin'
	));

Route::post('login', array(
	'before' => 'guest',
	'as' => 'auth.login.do',
	'uses' => '\AuthController@doLogin'
	));

Route::get('logout', array(
	'before' => 'auth',
	'as' => 'auth.logout.do',
	'uses' => '\AuthController@logout'
	));

Route::get('register', array(
	'before' => 'guest',
	'as' => 'auth.register.show',
	'uses' => '\AuthController@showRegister'
	));

Route::post('register', array(
	'before' => 'guest',
	'as' => 'auth.register.do',
	'uses' => '\AuthController@doRegister'
	));
