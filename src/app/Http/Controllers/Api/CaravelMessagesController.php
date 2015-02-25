<?php namespace App\Http\Controllers\Api;

class CaravelMessagesController extends \App\Http\Controllers\Controller {

	public function index(){
		$msg = [];
		if($_ENV['MAIL_PRETEND'] || $_ENV['MAIL_DRIVER'] || $_ENV['MAIL_HOST'] || $_ENV['MAIL_FROM_ADDRESS']){
			array_push($msg, 'Email does not appear to be properly configured. Normal during development bad in production.');
		}
		return ['msg' => $msg];
	}
}

