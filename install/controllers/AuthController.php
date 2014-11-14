<?php

//namespace Fimdomeio\Caravel;
use \Debugbar;

class AuthController extends BaseController {

	/**
	 * Show Login form
	 *
	 * @return Response
	 */
	public function showLogin()
	{
		$title = 'Login';
		return View::make('auth.login')
			->with('title', $title);
	}

	/**
	 * Login the user
	 *
	 * @return Response
	 */
	public function doLogin()
	{
		// validate the info, create rules for the inputs
		$rules = array(
			'email'    => 'required|email', // make sure the email is an actual email
			'password' => 'required|min:6' // password can only be alphanumeric and has to be greater than 3 characters
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::back()
				->withErrors($validator) // send back all errors to the login form
				->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
		} else {

			// create our user data for the authentication
			$userdata = array(
				'email' 	=> Input::get('email'),
				'password' 	=> Input::get('password')
			);

			// see if remember me is checked.
			if(null !== Input::get('remember_me')) {
				$remember_me = true;
			} else {
				$remember_me = false;
			}

			// attempt to do the login
			if (Auth::attempt($userdata, true)) {

				// Validation successful!
				// Redirect them to the secure section or whatever.
				// Return Redirect::intended('admin') to redirect the user to the URL they were trying to access before
				// being caught by the authentication filter or, if no URL was given, redirect to the admin page.
				return Redirect::intended('admin');

			} else {

				// validation not successful, send back to form	with errors
				// return Redirect::to('login')->with('global', 'There was a problem logging you in. Please check your credentials and try again.');
				return Redirect::back()->withErrors($validator)->withInput();

			}

		}
	}


	/**
	 * Logout and redirect to home
	 *
	 * @return Response
	 */
	public function logout()
	{
		Auth::logout();
		return Redirect::to('/');
	}


	/**
	 * Register form
	 *
	 * @return Response
	 */
	public function showRegister()
	{
		$title = 'Register';
		return View::make('auth.register')
			->with('title', $title);
	}


	/**
	 * Save the register data and redirect to login
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function doRegister()
	{
		$validator = Validator::make(Input::all(),
			[
				'username' => 'required|max:15|min:4|unique:users',
				'email' => 'required|max:50|email|unique:users',
				'password' => 'required|min:6|confirmed'
				//'password_confirmation' => 'required|same:password'
			]
		);

		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$user = new User;
		$user->username = Input::get('username');
		$user->email = Input::get('email');
		$user->password = Hash::make(Input::get('password'));
		$user->save();

		/*User::create([
			'username' => 'simbicort',
			'email' => 'jsworkbox@gmail.com',
			'password' => Hash::make('changeme')
		]);*/

		return Redirect::route('auth.login.show');
	}


}
