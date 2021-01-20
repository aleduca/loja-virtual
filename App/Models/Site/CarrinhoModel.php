<?php

namespace App\Models\Site;

use App\Models\Model;

class CarrinhoModel extends Model {

	public $table = 'carrinho';

	public function add(Array $attributes) {
		$sql = "insert into {$this->table}(produto,quantidade,sessao,expire, status) values(?,?,?,?,?)";
		$this->typeDatabase->prepare($sql);
		foreach ($attributes as $key => $value) {
			$this->typeDatabase->bindValue($key, $value);
		}
		return $this->typeDatabase->execute();
	}

	public function update($id, $qtd, $sessao) {
		$sql = "update {$this->table} set quantidade = ? where produto = ? and sessao = ?";
		$this->typeDatabase->prepare($sql);
		$this->typeDatabase->bindValue(1, $qtd);
		$this->typeDatabase->bindValue(2, $id);
		$this->typeDatabase->bindValue(3, $sessao);
		$this->typeDatabase->execute();
		return $this->typeDatabase->rowCount();
	}

	public function remove($id, $sessao) {
		$sql = "delete from {$this->table} where produto = ? and sessao = ?";
		$this->typeDatabase->prepare($sql);
		$this->typeDatabase->bindValue(1, $id);
		$this->typeDatabase->bindValue(2, $sessao);
		return $this->typeDatabase->execute();
	}

// Excecao para ser deixado aqui em model e nao em repositories
	public function carrinhoAbandonado() {
		$sql = "select * from {$this->table} where (NOW() > expire and status = 2) or (status = 1 and NOW() > expire + INTERVAL 1 DAY)";
		$this->typeDatabase->prepare($sql);
		$this->typeDatabase->execute();
		return $this->typeDatabase->fetchAll();
	}

}