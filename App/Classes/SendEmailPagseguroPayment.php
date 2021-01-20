<?php

namespace App\Classes;

use App\Classes\TemplateVendaAprovada;
use App\Interfaces\InterfaceEmailPayment;

class SendEmailPagseguroPayment implements InterfaceEmailPayment{
	
	private $email;
	private $transaction;

	public function __construct($transaction){
		$this->sendEmail = new SendEmail;
		$this->transaction = $transaction;
	}

	public function aguardePagamento(){
		
		$this->sendEmail->setMensagem(
		    ['nome' => $this->transaction->sender->name]
		);

		return $this->sendEmail->send(
		    ['contato@asolucoesweb.com.br',
		    $para,'Aguardando pagamento'],
		    new TemplateAguardePagamento
		);
	}

	public function vendaAprovada(){

		$this->sendEmail->setMensagem(
		    ['nome' => $this->transaction->sender->name]
		);

		return $this->sendEmail->send(
			// primeiro email é para e o segundo é quem
		    ['contato@asolucoesweb.com.br',
		    'asolucoesweb','Venda Aprovada'],
		    new TemplateVendaAprovada
		);
	}

	public function valorDevolvido(){
		return $transaction;
	}

	public function pagamentoAnalise()
	{
		throw new \Exception('Method not implemented');
	}

	public function pagamentoDisponivel()
	{
		throw new \Exception('Method not implemented');
	}

	public function emDisputa()
	{
		throw new \Exception('Method not implemented');
	}

	public function compraCancelada()
	{
		throw new \Exception('Method not implemented');
	}
}