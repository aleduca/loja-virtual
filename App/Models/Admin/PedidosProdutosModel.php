<?php

namespace App\Models\Admin;

use App\Models\Model;

class PedidosProdutosModel extends Model {
	public $table = 'pedidos_produtos';

	public function create($attributes) {
	}

	public function update(array $attributes, $id) {
		$sql = "update {$this->table} set quantidade = :quantidade,valor =:valor, subtotal = :subtotal where id = :id";

		$this->typeDatabase->prepare($sql);

		foreach ($attributes as $key => $attribute) {
			$this->typeDatabase->bindValue(":{$key}", $attribute);
		}
		$this->typeDatabase->bindValue(':id', $id);
		$this->typeDatabase->execute();
		return $this->typeDatabase->rowCount();
	}
}