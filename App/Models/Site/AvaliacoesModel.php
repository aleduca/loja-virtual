<?php

namespace App\Models\Site;

use App\Models\Model;

class AvaliacoesModel extends Model {

	public $table = 'avaliacoes';

	public function create($attributes) {
		$sql = "insert into {$this->table}(produto,cliente,estrelas) values(?,?,?)";
		$this->typeDatabase->prepare($sql);
		$i = 1;
		foreach ($attributes as $attribute) {
			$this->typeDatabase->bindValue($i, $attribute);
			$i++;
		}
		$this->typeDatabase->execute();
	}

	public function update($estrelas, $id) {
		$sql = "update {$this->table} set estrelas = ? where id = ?";
		$this->typeDatabase->prepare($sql);
		$this->typeDatabase->bindValue(1, $estrelas);
		$this->typeDatabase->bindValue(2, $id);
		$this->typeDatabase->execute();
	}

}
