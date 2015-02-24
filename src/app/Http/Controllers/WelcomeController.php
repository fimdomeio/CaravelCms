<?php namespace App\Http\Controllers;

use \App\Setting;
class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{

	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$allowRegistration = Setting::where('key', 'allowRegistration')->get();
		$err = null;
		$res = null;
		if(count($allowRegistration) != 1){
			$err = 'settingNotFound';
		}else{
			if($allowRegistration[0]->value == 1){
				$res = true;
			}else {
				$res = false;
			}
		}
		return view('welcome')->with('allowRegistration', $res )->with('err', $err);
	}

}
