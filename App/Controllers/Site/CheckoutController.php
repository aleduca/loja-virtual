<?php

namespace App\Controllers\Site;

use App\Classes\Authenticated;
use App\Classes\Carrinho;
use App\Classes\Checkout;
use App\Classes\CheckoutValidate;
use App\Classes\IdRandom;
use App\Classes\Pagseguro;
use App\Classes\Pedidos;
use App\Controllers\BaseController;
use App\Repositories\Site\ProdutosCarrinhoRepository;

class CheckoutController extends BaseController{
	
	public function index(){

		CheckoutValidate::queued();

		$pedidos = new Pedidos(new ProdutosCarrinhoRepository);
		if($pedidos->create(IdRandom())){

			$dadosUser = Authenticated::user();

			$checkout = new Checkout();
			$retorno = $checkout->checkoutAndPayment([
			     $dadosUser,
				'idReferencia' => IdRandom()
			], new Pagseguro);

			echo json_encode([
				'redirecionar' => 'sim',
				'url' => "https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code={$retorno->code}"
			]);

		}else{
			$pedidos->remove(IdRandom::generateId());
			echo json_encode('erroCadastro');
		}
	}
}