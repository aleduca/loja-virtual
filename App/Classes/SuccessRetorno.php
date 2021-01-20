<?php

namespace App\Classes;

use App\Classes\CarrinhoBanco;
use App\Classes\CarrinhoBancoBackup;
use App\Classes\Pedidos;
use App\Classes\QueueRetorno;
use App\Repositories\Site\ProdutosCarrinhoRepository;
//praticamente a mesma coisa que o queued operations, praticamente porque...
class SuccessRetorno extends QueueRetorno{
	
	private function carrinhoBackup($transaction){
		$carrinhoBancoBackup = new CarrinhoBancoBackup;
		$carrinhoBancoBackup->add($transaction->reference);
	}

	private function carrinhoBanco($transaction){
		$carrinhoBanco = new CarrinhoBanco;
		$carrinhoBanco->remove($transaction->reference);
	}

	private function pedidos($transaction){
		$pedidos = new Pedidos(new ProdutosCarrinhoRepository);	
		$pedidos->update($transaction->reference,$transaction->status,1);	
	}

	public function handle($transaction){
		$this->carrinhoBackup($transaction);
		$this->carrinhoBanco($transaction);
		$this->pedidos($transaction);
	}

}