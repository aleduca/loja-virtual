<?php

namespace App\Controllers\Site;

use App\Classes\FlashMessage;
use App\Classes\Logado;
use App\Classes\Logar;
use App\Classes\Login;
use App\Classes\Logout;
use App\Classes\MassFilter;
use App\Classes\Redirect;
use App\Controllers\BaseController;

class LoginController extends BaseController {

    public function index() {
        
        if (Logado::logado())  Redirect::redirect('/');

        $dados = [
            'titulo' => 'Curso PHPOO AWB | Logar'
        ];

        $template = $this->twig->loadTemplate('site_login.html');
        $template->display($dados);
    }

    public function logar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $filter = new MassFilter;
            $filter->filterInputs('email','password');

            if (Logar::logarUser($filter->get('email'),$filter->get('password'))) return Redirect::redirect('/');
            
            FlashMessage::add('login','Erro ao logar, usuário ou senha inválidos');    

            return Redirect::redirect('/login');
        }
        return Redirect::redirect('/');
    }

    public function logout() {
        Logout::logoutUser();

        Redirect::redirect('/');
    }

}
