<?php

namespace App\Classes;

use App\Classes\Carrinho;
use App\Classes\CarrinhoBanco;
use App\Classes\Pedidos;
use App\Classes\RetornaEstoque;
use App\Models\Site\CarrinhoModel;
use App\Repositories\Site\ProdutosCarrinhoRepository;

class CarrinhosAbandonados {

	public static function remove(RetornaEstoque $retornaEstoque) {
		return (new Static )->removeProducts($retornaEstoque);
	}

	private function carrinhosAbandonados() {
		$carrinhoModel = new CarrinhoModel;
		return $carrinhoModel->carrinhoAbandonado();
	}

	private function removeProducts($retornaEstoque) {
		foreach ($this->carrinhosAbandonados() as $produto) {
			(new Carrinho)->remove($produto->produto);
			(new CarrinhoBanco)->removeProduct($produto->produto, $produto->sessao);
			(new Pedidos(new ProdutosCarrinhoRepository))->remove($produto->sessao);
		}
	}

}
