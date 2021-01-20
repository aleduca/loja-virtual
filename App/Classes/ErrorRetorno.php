<?php

namespace App\Classes;

use App\Classes\CarrinhoBancoBackup;
use App\Classes\Pedidos;
use App\Classes\QueueRetorno;
use App\Classes\RetornaEstoqueBackup;
use App\Repositories\Site\ProdutosCarrinhoRepository;

class ErrorRetorno extends QueueRetorno{

	private function carrinhoBackup($transaction){
		$carrinhoBancoBackup = new CarrinhoBancoBackup;
		$carrinhoBancoBackup->remove($transaction->reference);
	}

	private function retornaEstoque($transaction){
		$retornaEstoqueBackup = new RetornaEstoqueBackup;
		$retornaEstoqueBackup->retornaEstoqueBackup($transaction->reference);
	}

	private function pedidos($transaction){
		$pedidos = new Pedidos(new ProdutosCarrinhoRepository);	
		$pedidos->remove($transaction->reference);	
	}

	public function handle($transaction){
		$this->retornaEstoque($transaction);
		$this->carrinhoBackup($transaction);
		$this->pedidos($transaction);
	}

}