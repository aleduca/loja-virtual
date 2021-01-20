<?php

namespace App\Controllers\Admin;

use App\Classes\ErrorsValidate;
use App\Classes\FlashMessage;
use App\Classes\Logar;
use App\Classes\Logout;
use App\Classes\MassFilter;
use App\Classes\Redirect;
use App\Classes\Validate;
use App\Controllers\BaseController;

class AdminLoginController extends BaseController {

	public function store() {

		$rules = [
			'email' => 'required|email',
			'password' => 'required',
		];

		$validate = new Validate($rules);
		$validate->validate();

		if (!ErrorsValidate::hasError()) {

			$filter = new MassFilter();
			$filter->filterInputs('email', 'password');

			$logado = Logar::logarUser($filter->get('email'), $filter->get('password'));

			if ($logado) {
				return Redirect::redirect('/painel');
			}

			FlashMessage::add('erro_login', 'Erro ao logar, usuário ou senha inválidos');
			return Redirect::back();

		} else {
			dd('aqui');
			FlashMessage::add('erro_login', 'Erro ao logar, tente novamente');
			Redirect::back();
		}

	}

	public function destroy() {
		Logout::logoutAdmin();
		return Redirect::redirect('/admin');
	}

}