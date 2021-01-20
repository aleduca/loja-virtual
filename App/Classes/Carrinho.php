<?php

namespace App\Classes;

use App\Classes\Estoque;
use App\Classes\Frete;
use App\Classes\IdRandom;
use App\Classes\StatusCarrinho;
use App\Models\Site\CarrinhoModel;

class Carrinho {

	private $statusCarrinho;
	private $carrinhoModel;
	private $estoque;

	public function __construct() {
		$this->statusCarrinho = new StatusCarrinho();
		$this->carrinhoModel = new CarrinhoModel();
		$this->estoque = new Estoque();
	}

/**
 *
 * @param type $id id do produto
 */
	public function add($id) {
		if ($this->estoque->estoqueAtual($id) > 1) {
			if ($this->statusCarrinho->produtoEstaNoCarrinho($id)) {
				$_SESSION['carrinho'][$id] += 1;
				$this->carrinhoModel->update($id, $this->produtoCarrinho($id), IdRandom::generateId());
			} else {
				$this->carrinhoModel->add([
					1 => $id,
					2 => 1,
					3 => IdRandom::generateId(),
					4 => date('Y-m-d H:i:s', strtotime('+10minutes')),
					5 => 2,
				]);
				$_SESSION['carrinho'][$id] = 1;
			}
			$this->estoque->atualizaEstoque($id, ($this->estoque->estoqueAtual($id) - 1));
			echo 'adicionado';
		}
	}

	public function produtoCarrinho($id) {
		return $_SESSION['carrinho'][$id];
	}

/**
 *
 * @param type $id id do produto
 * @param type $qtd quantidade do produto no carrinho
 */
	public function update($id, $qtd) {
		if ($this->statusCarrinho->produtoEstaNoCarrinho($id)) {

//              pegando estoque atual do produto
			$estoqueAtual = $this->estoque->estoqueAtual($id);
			$diferenca = abs($_SESSION['carrinho'][$id] - $qtd);

			if ($qtd < $_SESSION['carrinho'][$id]) {
				$estoque = $estoqueAtual + $diferenca;
			} else {
				$estoque = $estoqueAtual - $diferenca;
			}

			if ($estoque < 0) {
				echo 'semestoque';
				die();
			}

			$this->estoque->atualizaEstoque($id, $estoque);
		}

		$_SESSION['carrinho'][$id] = $qtd;

		$this->carrinhoModel->update($id, $qtd);
		// echo 'atualizado';
	}

	public function remove($id) {
		if ($this->statusCarrinho->produtoEstaNoCarrinho($id)) {
			$this->carrinhoModel->delete('id', $id);
			$this->estoque->atualizaEstoque($id, ($this->estoque->estoqueAtual($id) + $this->produtoCarrinho($id)));
			unset($_SESSION['carrinho'][$id]);
			Frete::limparFrete();
		}
	}

/**
 * limpa todos produtos do carrinho
 */
	public function clear() {
		if ($this->statusCarrinho->carrinhoExiste()) {
			unset($_SESSION['carrinho']);
		}
	}

/**
 *
 * @return type carrinho de compra com todos produtos
 */
	public function produtosCarrinho() {
		if ($this->statusCarrinho->carrinhoExiste()) {
			return $this->statusCarrinho->carrinho();
		}
	}

}
