<?php

namespace App\Classes;

use App\Classes\Redirect;

class Logado {
    public static function logado() {
        if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
            return true;
        }
        return false;
    }

    public static function adminLogado() {
        if (!isset($_SESSION['admin_logado']) || $_SESSION['admin_logado'] === false) {
            Redirect::redirect('/');
        }
        return true;
    }

}