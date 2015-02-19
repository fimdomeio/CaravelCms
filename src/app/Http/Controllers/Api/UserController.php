<?php namespace App\Http\Controllers\Api;

class UserController extends \App\Http\Controllers\Controller {

	public function whoAmI(){
		return \Auth::user();
	}

}