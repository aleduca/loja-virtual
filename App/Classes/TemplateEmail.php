<?php

namespace App\Classes;

class TemplateEmail {

    private $allKeys = [];
    private $allValues = [];

    const PATH_TO_EMAILS_FORMATED = 'Emails/';

    public function replaceVariables($template, $dados) {
        foreach ($dados as $key => $dado) {
            $this->allKeys[] = '#' . $key;
            $this->allValues[].=$dado;
        }
        $data = str_replace($this->allKeys, $this->allValues, $template);
        return $data;
    }

}
