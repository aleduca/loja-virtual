<?php

namespace App\Classes;

use App\Interfaces\InterfaceTemplateEmail;
use App\Classes\TemplateEmail;

class TemplateEmDisputa extends TemplateEmail implements InterfaceTemplateEmail {

    public function template($dados) {
        $template = file_get_contents(parent::PATH_TO_EMAILS_FORMATED . DIRECTORY_SEPARATOR.'email_disputa.php');
        return $this->replaceVariables($template, $dados);
    }

}
