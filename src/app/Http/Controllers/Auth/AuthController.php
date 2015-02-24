<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Http\Request;

use \App\User;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}

	public function getLogin()
	{
		return view('auth.login')->with('hideMenu', true);
	}

	public function postLogin(Request $request)
	{
		$this->validate($request, [
			'email' => 'required', 'password' => 'required',
		]);

		$credentials = $request->only('email', 'password');

		$credentials['confirmed'] = 1;
		if ($this->auth->attempt($credentials, $request->has('remember')))
		{
			return redirect()->intended($this->redirectPath());
		}

		return redirect($this->loginPath())
					->withInput($request->only('email', 'remember'))
					->withErrors([
						'email' => 'These credentials do not match our records or account not active.',
					]);
	}

	public function getRegister()
	{
		return view('auth.register')->with('hideMenu', true);
	}

	public function postRegister(Request $request)
	{
		$validator = $this->registrar->validator($request->all());

		if ($validator->fails())
		{
			$this->throwValidationException(
				$request, $validator
			);
		}
		$user = $this->registrar->create($request->all());
		$user->confirmationString = substr(sha1(rand()), 0, 32);
		$user->confirmed = false;
		if(User::count() == 1){
			$adminId = \App\Role::where('name', 'admin')->first()->id;
			$user->roles()->attach($adminId);
		}else{
			$editorId = \App\Role::where('name', 'editor')->first()->id;
			$user->roles()->attach($editorId);
		}

		$user->push();
		return View('auth.successful-registration')->with('hideMenu', true);

	}

	public function redirectPath()
	{
		if (property_exists($this, 'redirectPath'))
		{
			return $this->redirectPath;
		}

		return property_exists($this, 'redirectTo') ? $this->redirectTo : '/admin';
	}

	public function getConfirm($confirmationString){
		$user = User::where('confirmationString', $confirmationString)->first();
		$success = null;
		if(!is_null($user)){
			$user->confirmed = true;
			$user->save();
			$success = true;
		}else {
			$success = false;
		}
		
		return View('auth.successful-confirmation')->with('hideMenu', true)->with('success', $success);
	}

}
