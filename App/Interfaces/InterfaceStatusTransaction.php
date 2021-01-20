<?php

namespace App\Interfaces;

interface InterfaceStatusTransaction{
	public function aguardePagamento($transaction);
	public function pagamentoAnalise($transaction);
	public function vendaAprovada($transaction);
	public function pagamentoDisponivel($transaction);
	public function emDisputa($transaction);
	public function valorDevolvido($transaction);
	public function compraCancelada($transaction);
}