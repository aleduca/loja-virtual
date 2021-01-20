<?php

namespace App\Classes;

use App\Classes\Auth;
use App\Classes\Redirect;
use App\Models\Site\UserModel;

class Logar{

	public static function logarUser($email, $password){
		$login = new Auth($email,$password);
		return $login->logar(new UserModel);
	}
	
}