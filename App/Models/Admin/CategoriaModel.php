<?php

namespace App\Models\Admin;

use App\Models\Model;

class CategoriaModel extends Model {
	public $table = 'categorias';

	public function create(array $attributes) {
		$sql = "insert into {$this->table}(categoria_nome,categoria_slug) values(?,?)";
		$this->typeDatabase->prepare($sql);
		$i = 1;
		foreach ($attributes as $attribute) {
			$this->typeDatabase->bindValue($i, $attribute);
			$i++;
		}
		return $this->typeDatabase->execute();
	}

	public function update($attributes, $id) {
		$sql = "update {$this->table} set categoria_nome = :categoria_nome,categoria_slug =:categoria_slug where id = :id";

		$this->typeDatabase->prepare($sql);

		foreach ($attributes as $key => $attribute) {
			$this->typeDatabase->bindValue(":{$key}", $attribute);
		}

		$this->typeDatabase->bindValue(':id', $id);

		$this->typeDatabase->execute();

		return $this->typeDatabase->rowCount();
	}

}