<?php

namespace App\Repositories\Site;

use App\Models\Site\EstoqueModel;

class EstoqueRepository {

	private $estoque;

	public function __construct() {
		$this->estoque = new EstoqueModel;
	}

	public function quantidadeProdutoEstoque($id) {
		$sql = "select * from {$this->estoque->table} where estoque_produto = ?";
		$this->estoque->typeDatabase->prepare($sql);
		$this->estoque->typeDatabase->bindValue(1, $id);
		$this->estoque->typeDatabase->execute();
		return $this->estoque->typeDatabase->fetch();
	}

}
