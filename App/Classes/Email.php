<?php

namespace App\Classes;

use App\Interfaces\InterfaceTemplateEmail;

class Email {

    private $email;
    private $quem;
    private $para;
    private $assunto;
    private $mensagem;
    private $template;
    private $copia = [];

    public function setQuem($quem) {
        $this->quem = $quem;
    }

    public function setPara($para) {
        $this->para = $para;
    }

    public function setAssunto($assunto) {
        $this->assunto = $assunto;
    }

    public function setMensagem($mensagem) {
        $this->mensagem = $mensagem;
    }

    public function setTemplate(InterfaceTemplateEmail $template) {
        $this->template = $template;
    }

    public function setCopia($copia) {
        $this->copia = $copia;
    }

    public function __construct() {
        $this->email = new \PHPMailer();
    }

    public function enviar() {
        $this->email->CharSet = 'UTF-8';
        $this->email->SMTPSecure = 'ssl';
        $this->email->isSMTP();
        $this->email->Host = "br74.hostgator.com.br";
        $this->email->Port = 465;
        $this->email->SMTPAuth = true;
        $this->email->Username = "contato@asolucoesweb.com.br";
        $this->email->Password = "contato2015!!";
        $this->email->isHTML(true);
        $this->email->setFrom('');
        $this->email->FromName = $this->quem;
        $this->email->addAddress($this->para);
        $this->email->Body = $this->mensagem;
        if (isset($this->copia)) {
            foreach ($this->copia as $copia) {
                $this->email->addAddress($copia);
            }
        }
        $this->email->Subject = $this->assunto;
        $this->email->AltBody = 'Para ver esse email tenha certeza de estar vendo em um programa que aceita ver HTML';
        $this->email->MsgHTML($this->template->template($this->mensagem));
        if (!$this->email->send()) {
            var_dump($this->email->ErrorInfo);
            return false;
        }
        return true;
    }
}