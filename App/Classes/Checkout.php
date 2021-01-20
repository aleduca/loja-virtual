<?php 

namespace App\Classes;

use App\Classes\Carrinho;
use App\Classes\CarrinhoBanco;
use App\Interfaces\InterfacePayment;

class Checkout {
	
	public function checkoutAndPayment(array $data, InterfacePayment $payment){
		
		$returnPayment = $payment->dataAndPayment($data);
		
		$this->atualizaStatusCarrinhoBanco();
		$this->limparCarrinho();
		
		return $returnPayment;

	}

	private function limparCarrinho(){
		Carrinho::clear();
		IdRandom::clear();
	}


	private function atualizaStatusCarrinhoBanco(){
		$carrinhoBanco = new CarrinhoBanco();
		$carrinhoBanco->updateStatus(IdRandom());
	}
}