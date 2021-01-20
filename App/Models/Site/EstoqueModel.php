<?php

namespace App\Models\Site;

use App\Models\Model;

class EstoqueModel extends Model {

	public $table = 'estoque';

//    pega a quantidade em estoque de um determinado produto
	public function quantidadeProdutoNoEstoque($id) {
		$sql = "select estoque_quantidade from {$this->table} where estoque_produto = ?";
		$this->typeDatabase->prepare($sql);
		$this->typeDatabase->bindValue(1, $id);
		$this->typeDatabase->execute();
		return $this->typeDatabase->fetch();
	}

//    atualiza a quantidade no estoque de um determinado produto
	public function update($id, $qtd) {
		$sql = "update {$this->table} set estoque_quantidade = ? where estoque_produto = ?";
		$this->typeDatabase->prepare($sql);
		$this->typeDatabase->bindValue(1, $qtd);
		$this->typeDatabase->bindValue(2, $id);
		return $this->typeDatabase->execute();
	}

//    adicionar produto no estoque
	public function add($id, $qtd) {
		$sql = "insert into {$this->table}(estoque_produto,estoque_quantidade) values(?,?)";
		$this->typeDatabase->prepare($sql);
		$this->typeDatabase->bindValue(1, $id);
		$this->typeDatabase->bindValue(2, $qtd);
		return $this->typeDatabase->execute();
	}

}
