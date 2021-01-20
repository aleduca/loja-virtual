<?php

namespace App\Repositories\Site;

use App\Classes\Carrinho;
use App\Models\Site\ProdutoModel;

class ProdutosCarrinhoRepository {

	private $produtoModel;
	private $carrinho;

	public function __construct() {
		$this->carrinho = new Carrinho;
		$this->produtoModel = new ProdutoModel;
	}

/**
 *
 * @return type produtos que estao no carrinho
 */
	public function produtosNoCarrinho() {
		$produtos = [];

		if (empty($this->carrinho->produtosCarrinho())) {
			return [];
		}

		foreach ($this->carrinho->produtosCarrinho() as $id => $qtd) {
			$produtoCarrinho = $this->produtoModel->find('id', $id);
			$valorProduto = ($produtoCarrinho->produto_promocao == 1) ? $produtoCarrinho->produto_valor_promocao : $produtoCarrinho->produto_valor;

			$produtos[] = [
				'produtos' => $produtoCarrinho,
				'subtotal' => $valorProduto * $qtd,
				'qtd' => $qtd,
				'valor' => $valorProduto,
			];
		}
		return $produtos;
	}

	/**
	 *
	 * @return type valor total da compra
	 */
	public function totalProdutoscarrinho() {
		$total = 0;
		if ($this->carrinho->produtosCarrinho() > 0) {
			foreach ($this->carrinho->produtosCarrinho() as $id => $qtd) {
				$produtoCarrinho = $this->produtoModel->find('id', $id);
				$valorProduto = ($produtoCarrinho->produto_promocao == 1) ? $produtoCarrinho->produto_valor_promocao : $produtoCarrinho->produto_valor;
				$total += $valorProduto * $qtd;
			}
		}
		return $total;
	}

}
