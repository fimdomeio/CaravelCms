<?php namespace Caravel\Http\Controllers;

class CaravelController extends Controller {

	public function issues(){
		ini_set('user_agent','Caravel');
		$issuesResponse = file_get_contents('https://api.github.com/repos/fimdomeio/CaravelCms/issues?state=open');
		if(empty($issuesResponse)){
			$data = array('data' => '', 'error' => 'nothing was returned'); 
			return $data;
		}
		$data = json_decode($issuesResponse);
		return $data;
	}
}