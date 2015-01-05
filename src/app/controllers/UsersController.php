
<?php

class UsersController extends BaseController {
	
	public function isAuthorized(){
		return ['authorized' => Sentry::check()];
	}
}