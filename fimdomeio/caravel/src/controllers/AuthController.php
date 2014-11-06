<?php

namespace Fimdomeio\Caravel;
use \Debugbar;

class AuthController extends \BaseController {

	/**
	 * Show Login form
	 *
	 * @return Response
	 */
	public function showLogin()
	{
		$title = 'Login';
		return \View::make('caravel::auth.login')
			->with('title', $title);
	}

	/**
	 * Login the user
	 *
	 * @return Response
	 */
	public function doLogin()
	{
		//
	}


	/**
	 * Logout and redirect to home
	 *
	 * @return Response
	 */
	public function logout()
	{
		return \Redirect::route('/');
	}


	/**
	 * Register form
	 *
	 * @return Response
	 */
	public function showRegister()
	{
		return \View::make('caravel::auth.register');
	}


	/**
	 * Save the register data and redirect to login
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function store($id)
	{
		$validator = Validator::make(Input::all(),['username' => 'required', 'password' => 'required']);

		if ($validator->fails()) return 'failed validation';

		$user = new User;
		$user->username = 'simbicort';
		$user->email = 'jsworkbox@gmail.com';
		$user->password = Hash::make('changeme');
		$user->save();

		/*User::create([
			'username' => 'simbicort',
			'email' => 'jsworkbox@gmail.com',
			'password' => Hash::make('changeme')
		]);*/

		return \Redirect::route('login');
	}


}
