<?php namespace Caravel\Http\Controllers\Api;

class IssuesController extends \Caravel\Http\Controllers\Controller {
	
	public function gitHub(){
		ini_set('user_agent','Caravel'); 
		$issues = file_get_contents('https://api.github.com/repos/fimdomeio/CaravelCms/issues?state=open');
		if(!$issues){
			return ['data' => null, 'error' => 'nothing was returned'];
		}
		$issues = json_decode($issues);
		return $issues;
	}

}