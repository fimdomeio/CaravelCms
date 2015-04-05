<?php namespace Caravel\Http\Controllers\Api;

class UserController extends \Caravel\Http\Controllers\Controller {

	public function whoAmI(){
		return \Auth::user();
	}

}