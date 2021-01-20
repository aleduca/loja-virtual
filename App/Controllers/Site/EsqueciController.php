<?php

namespace App\Controllers\Site;

use App\Classes\ErrorsValidate;
use App\Classes\FlashMessage;
use App\Classes\Redirect;
use App\Classes\SendEmail;
use App\Classes\TemplateRedefinirSenha;
use App\Classes\Validate;
use App\Controllers\BaseController;
use App\Models\Site\PasswordReminderModel;
use App\Models\Site\UserModel;

class EsqueciController extends BaseController{

	private $passwordReminder;

	public function __construct(){
		$this->passwordReminder = new PasswordReminderModel;
	}
	
	public function index(){
		$dados = [
		    'titulo' => 'Curso PHPOO AWB | Esqueci a senha'
		];

		$template = $this->twig->loadTemplate('site_esqueci.html');
		$template->display($dados);	
	}

	public function send(){
		
		$rules = [
			'email' => 'required|email'
		];

		$validate = new Validate($rules);
		$validate->validate();

		if(!ErrorsValidate::erroValidacao()){
			$userModel = new UserModel;

			$emailFiltrado = filter_var($_POST['email'], FILTER_SANITIZE_STRING);

			$userEncontrado = $userModel->find('email', $emailFiltrado);

			if($userEncontrado){

				$this->passwordReminder->delete('user', $userEncontrado->id);
				$this->passwordReminder->create([
					$userEncontrado->id,date('Y-m-d H:i:s'), date('Y-m-d H:i:s', strtotime('+1hour')),idRandom()
				]);

				$sendEmail = new SendEmail;
				$sendEmail->setMensagem([
					'nome' => $userEncontrado->name,
					'copy' => 'http://localhost:8888/esqueci/senha/'.idRandom(),
					'link' => '<a href="http://localhost:8888/esqueci/senha/'.idRandom().'">Clique aqui para redfinir sua senha</a>',
					'data' => date('d/m/Y H:i:s')
				]);

				$sendEmail->send(
					['contato@asolucoesweb.com.br',
					$userEncontrado->email,'Atualize sua senha'], 
					new TemplateRedefinirSenha
				);

				echo 'enviado';

			}else{
				FlashMessage::add('esqueci','Nao encontramos esse email em nosso banco de dados');
				echo 'user';
			}
		}else{
			echo 'user';
		}

	}

	public function senha($params){
		$dadosPassword = $this->passwordReminder->find('hash',$params[0]);

		if(!$dadosPassword){
			return Redirect::redirect('/');
		}

		if(strtotime($dadosPassword->expire) < strtotime(date('Y-m-d H:i:s'))){
			return Redirect::redirect('/');
		}

		$dados = [
		    'titulo' => 'Curso PHPOO AWB | Reset Password',
		    'hash' => $dadosPassword->hash
		];

		$template = $this->twig->loadTemplate('site_reset_password.html');
		$template->display($dados);


	}

}