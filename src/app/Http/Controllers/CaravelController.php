<?php namespace App\Http\Controllers;

class CaravelController extends Controller {
	
	public function issues(){
		ini_set('user_agent','Caravel'); 
		$issues = file_get_contents('https://api.github.com/repos/fimdomeio/CaravelCms/issues?state=open');
		if(!$issues){
			return ['data' => null, 'error' => 'nothing was returned'];
		}
		$issues = json_decode($issues);
		return $issues;
	}

	public function isAuthorized(){
		return ['authorized' => \Auth::check()];
	}
}