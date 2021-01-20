<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Classes\Redirect;
use App\Classes\Logado;
use App\Models\Site\UserModel;

class ContaController extends BaseController {

    public function index() {

        $logado = new Logado();

        $redirect = new Redirect();
        if (!$logado->logado()) {
            $redirect->redirect('/');
        }

        $userModel = new UserModel();
        $dadosUser = $userModel->find('id', $_SESSION['id']);

        $dados = [
            'titulo' => 'Curso PHPOO AWB | Conta do usuário',
            'user' => $dadosUser
        ];

        $template = $this->twig->loadTemplate('site_conta.html');
        $template->display($dados);
    }

}
