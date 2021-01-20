<?php

namespace App\Controllers\Site;

use App\Classes\ErrorsValidate;
use App\Classes\FlashMessage;
use App\Classes\Logar;
use App\Classes\MassFilter;
use App\Classes\Password;
use App\Classes\Redirect;
use App\Classes\Validate;
use App\Controllers\BaseController;
use App\Models\Site\PasswordReminderModel;
use App\Models\Site\UserModel;

class PasswordController extends BaseController{
	
	public function reset($params){
		
		$rules = [
			'password' => 'required'
		];

		$validate = new Validate($rules);
		$validate->validate();

		if(!ErrorsValidate::erroValidacao()){

			$passwordReminder = new PasswordReminderModel;
			$dadosPasswordReminder = $passwordReminder->find('hash',$params[0]);

			$userModel = new UserModel;
			$dadosUser = $userModel->find('id', $dadosPasswordReminder->user);

			$filter = new MassFilter;
			$filter->filterInputs('password');

			$updated = $userModel->updatePassword(Password::hash($filter->get('password')),$dadosUser->email);

			if($updated){
				Logar::logarUser($dadosUser->email, $filter->get('password'));

				return Redirect::redirect('/');
			}

			FlashMessage::add('password','Erro ao atualizar sua senha , por favor tente novamente');
			return Redirect::back('/');

		}else{
			Redirect::back('/');
		}


	}

}