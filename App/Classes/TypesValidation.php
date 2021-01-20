<?php

namespace App\Classes;

use App\Classes\ErrorsValidate;

class TypesValidation {

    public static function required($field) {
        if (empty($_POST[$field])) {
            $message = "O campo é obrigatório";
            ErrorsValidate::add($field, $message);
        }
    }

    public static function email($field) {
        if (!filter_var($_POST[$field], FILTER_VALIDATE_EMAIL)) {
            $message = "O campo deve ter um email válido";
            ErrorsValidate::add($field, $message);
        }
    }

    public function phone() {
        
    }

    public function cep() {
        
    }

    public function ddd() {
        
    }

}
