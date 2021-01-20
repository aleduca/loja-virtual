<?php 

namespace App\Classes;

use App\Classes\Email;
use App\Classes\FlashMessage;
use App\Classes\PersistInput;
use App\Classes\Redirect;
use App\Interfaces\InterfaceTemplateEmail;

class SendEmail {

	private $mensagem;
	private $mail;

	public function __construct(){
		$this->mail = new Email;
	}

	public function setMensagem($mensagem){
		$this->mensagem = $mensagem;
	}

	private function validateAndSend(){
	    if($this->mail->enviar()){
	    	FlashMessage::add('contato', 'Email enviado com sucesso', 'success');	
	    	PersistInput::removeInputs(); 
	    }else{
	    	FlashMessage::add('contato', 'Erro ao enviar email');	
		}
	}

	public function send(array $dataEmail, InterfaceTemplateEmail $template){
        $this->mail->setPara($dataEmail[0]);
        $this->mail->setQuem($dataEmail[1]);
        $this->mail->setAssunto($dataEmail[2]);
        $this->mail->setMensagem($this->mensagem);
        $this->mail->setTemplate($template);
      	$this->validateAndSend();
	}
}