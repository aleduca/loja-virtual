<?php

namespace App\Models\Admin;

use App\Models\Model;

class EstoqueModel extends Model {

	public $table = 'estoque';

	public function update($id, $qtd) {
		$sql = "update {$this->table} set estoque_quantidade = ? where estoque_produto = ?";
		$this->typeDatabase->prepare($sql);
		$this->typeDatabase->bindValue(1, $qtd);
		$this->typeDatabase->bindValue(2, $id);
		return $this->typeDatabase->execute();
	}
	
	public function create($attributes){
		$sql = "insert into {$this->table}(estoque_produto,estoque_quantidade) values(?,?)";
		$this->typeDatabase->prepare($sql);
		$i = 1;
		foreach($attributes as $attribute){
			$this->typeDatabase->bindValue($i,$attribute);
			$i++;
		}
		return $this->typeDatabase->execute();
	}

}