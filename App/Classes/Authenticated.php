<?php

namespace App\Classes;

use App\Classes\User;
use App\Models\Site\UserModel;

class Authenticated {

	public static function user(){
		if(Logado::Logado() || Logado::adminLogado()){
			$user = new User();
			return $user->user(new UserModel);
		}
		throw new Exception("Você precisa estar logado para pegar os dados do user");
	}

}