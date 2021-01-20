<?php

namespace App\Controllers\Site;

use App\Classes\ErrorsValidate;
use App\Classes\Filters;
use App\Classes\FlashMessage;
use App\Classes\Logado;
use App\Classes\Logar;
use App\Classes\MassFilter;
use App\Classes\Password;
use App\Classes\PersistInput;
use App\Classes\Redirect;
use App\Classes\RepeatedRegistersSite;
use App\Classes\Validate;
use App\Controllers\BaseController;
use App\Models\Site\UserModel;

class CadastroController extends BaseController {

    private $userModel;

    public function __construct(){
        $this->userModel = new UserModel;
    }

    public function index() {
        $dados = [
            'titulo' => 'Curso PHPOO AWB | Cadastro'
        ];

        $template = $this->twig->loadTemplate('site_cadastro.html');
        $template->display($dados);
    }

    public function cadastrar() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $rules = [
                'nome' => 'required',
                'sobrenome' => 'required',
                'cep' => 'required',
                'telefone' => 'required:user',
                'email' => 'required|email:user',
                'ddd' => 'required'
            ];

            $validate = new Validate($rules);
            $validate->validate($rules)->repeatedRegisters(new RepeatedRegistersSite);

            if (!ErrorsValidate::erroValidacao()) {

                $filter = new MassFilter;
                $filter->filterInputs('name','sobrenome','is_admin:int=2',
                                      'email:email','password','ddd:int','telefone:int',
                                      'endereco','bairro','cidade','cep',
                                      'estado');
        
                if ($this->userModel->create($filter->all(true))) {
                    FlashMessage::add('mensagem_cadastro', 'Cadastrado com sucesso !!!', 'success');
                    PersistInput::removeInputs();

                    Logar::logarUser($filter->get('email'),$filter->get('password'));

                    if(Logado::logado()) return Redirect::redirect('/');

                    return Redirect::redirect('/cadastro');
                }

                FlashMessage::add('mensagem_cadastro', 'Erro ao cadastrar, tente novamente');
                return Redirect::redirect('/cadastro');

            } else {
                Redirect::redirect('/cadastro');
            }
        }
    }

    public function atualizar() {
        
    }

}
