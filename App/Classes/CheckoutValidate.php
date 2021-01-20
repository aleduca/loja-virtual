<?php

namespace App\Classes;

use App\Classes\Frete;
use App\Classes\Logado;
use App\Classes\QueueHandle;
use App\Repositories\Site\ProdutosCarrinhoRepository;
use App\Traits\ErrorsCheckoutValidate;

class CheckoutValidate extends QueueHandle{
	
	// Funcionalidade para o checkoutValidate, por isso esta na trait
	use ErrorsCheckoutValidate;

	// pode usar assim, ao inves da heranca
	// public function queueOperations(){
	// 	return (new Static)->handle();
	// }

	public function handle(){
		$this->cartExist();
		$this->isLoggedIn();
		$this->isFreteCalculated();
	}

	private function cartExist(){
		$produtosCarrinho = new ProdutosCarrinhoRepository;
		$produtosNoCarrinho = $produtosCarrinho->produtosNoCarrinho();
		if(empty($produtosNoCarrinho)){
			$this->error('empty');
		}
	}

	private function isLoggedIn(){
		$logado = new Logado();
		if(!$logado->logado()){
			$this->error('notLoggedIn');
		}
	}

	private function isFreteCalculated(){
		$frete = new Frete;
		if($frete->pegarFrete() == 0){
			$this->error('frete');
		}
	}
}