<?php

namespace App\Controllers\Site;

use App\Classes\ErrorsValidate;
use App\Classes\Redirect;
use App\Classes\SendEmail;
use App\Classes\TemplateContato;
use App\Classes\Validate;
use App\Controllers\BaseController;

class ContatoController extends BaseController {

	public function index() {
		$dados = [
			'titulo' => 'Curso PHPOO AWB | Contato',
		];

		$template = $this->twig->loadTemplate('site_contato.html');
		$template->display($dados);
	}

	public function enviar() {

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$rules = [
				'nome' => 'required',
				'email' => 'required|email',
				'assunto' => 'required',
				'mensagem' => 'required',
			];

			$validate = new Validate($rules);
			$validate->validate();

			if (!ErrorsValidate::erroValidacao()) {

				$filter = new MassFilter;
				$filter->filterInputs('name', 'email', 'assunto', 'mensagem');

				$sendEmail = new SendEmail;
				$sendEmail->setMensagem([
					'nome' => $filter->get('nome'),
					'data' => date('d/m/Y H:is'),
					'mensagem' => $filter->get('mensagem'),
				]);

				$sendEmail->send([
					'contato@asolucoesweb.com.br',
					$filter->get('email'), $filter->get('assunto'),
				], new TemplateContato);

				return Redirect::redirect('/contato');

			}
			return Redirect::redirect('/contato');
		}
	}

}
