<?php

namespace App\Classes;

use App\Classes\Password;
use App\Models\Model;

class Auth {

    private $email;
    private $password;

    public function __construct($email, $password){
        $this->email = $email;
        $this->password = $password;
    }

    private function loginStatus($status){
        if($status == 2){
            unset($_SESSION['admin_logado']);
            $_SESSION['logado'] = true;
        }else{
            $_SESSION['admin_logado'] = true;
            $_SESSION['logado'] = true;
        }
    }

    public function logar(Model $model) {

        $userEncontrado = $model->find('email', $this->email);

        if (!$userEncontrado) return false;

        if (Password::verificarPassword($this->password, $userEncontrado->password)) {
            $_SESSION['id'] = $userEncontrado->id;
            $_SESSION['name'] = $userEncontrado->name;
            $this->loginStatus($userEncontrado->is_admin);
            return true;
        }
        return false;
    }

}
