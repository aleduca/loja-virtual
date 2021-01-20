<?php

namespace App\Classes;

use App\Classes\Estoque;

class EstoqueCarrinho {

	private $estoque;

	public function __construct() {
		$this->estoque = new Estoque;
	}

	private function estoqueAtual($id) {
		return $this->estoque->estoqueAtual($id);
	}

	private function diferenca($id, $quantidade) {
		return abs($_SESSION['carrinho'][$id] - $quantidade);
	}

	private function verificaEstoque($id, $quantidade) {
		if (!$this->estoque->temNoEstoque($id, $quantidade)) {
			echo 'semEstoque';
			die();
		}
	}

	private function somaEstoque($id, $diferenca) {
		(!$this->estoqueAtual($id) > $diferenca) ?: $this->estoque->atualizaEstoque($id,
			$this->estoqueAtual($id) + $diferenca
		);
	}

	private function diminuiEstoque($id, $diferenca) {
		$this->estoque->atualizaEstoque($id, (
			$this->estoqueAtual($id) - $diferenca
		));
	}

	public function gerenciaEstoque($id, $quantidade) {

		$diferenca = $this->diferenca($id, $quantidade);

		$this->verificaEstoque($id, $quantidade);

		if ($_SESSION['carrinho'][$id] > $quantidade) {
			$this->somaEstoque($id, $diferenca);
		} else {
			$this->diminuiEstoque($id, $diferenca);
		}

	}

}
