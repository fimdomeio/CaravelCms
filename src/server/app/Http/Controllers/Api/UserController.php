<?php namespace Caravel\Http\Controllers\Api;

class UserController extends \Caravel\Http\Controllers\Controller {
use App\Transformers\UserTransformer;


  public function me(){
		$me = \Auth::user();
		$user = null;
		if(!empty($me)){
		$user = \App\User::where('id', $me->id)
			->where('confirmed', 1)
			->with(['roles' => function($query){
    	    $query->select('name');
    		}])
 			->first(['id', 'name', 'email']);
 		}
 		if(count($user)){
 			$res = array(
 				'status' => 'ok',
 				'data' => array(
 					'users' => array(
 						'name' => $user->name,
 						'email' => $user->email,
 						'roles' => array(
 							'data' => array(
 								'name' => $user->roles[0]->name
 							)
 						)
 					)
 				)
 			);
 		}else {
 			$res = array(
 				'status' => 'ok',
 				'data' => array()
 			);
 		}
		return \Response::json($res);
	}

}