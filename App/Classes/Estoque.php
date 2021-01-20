<?php
namespace App\Classes;

use App\Models\Site\EstoqueModel;
use App\Repositories\Site\EstoqueRepository;

class Estoque {

	private $estoqueRepository;

	public function __construct() {
		$this->estoqueRepository = new EstoqueRepository;
	}

	public function estoqueAtual($id) {
		return $this->estoqueRepository->quantidadeProdutoEstoque($id)->estoque_quantidade;
	}

	public function temNoEstoque($idProduto, $quantidadeProdutoCarrinho) {
		return ($this->estoqueAtual($idProduto) < $quantidadeProdutoCarrinho);
	}

	public function atualizaEstoque($id, $qtd) {
		$estoqueModel = new EstoqueModel();
		$estoqueModel->update($id, $qtd);
	}

}