<?php

namespace App\Models\Admin;

use App\Models\Model;

class UserModel extends Model {

	public $table = "users";

	public function create(Array $attributes) {
		$sql = "insert into {$this->table}(name,sobrenome,is_admin,email,password,ddd,telefone, endereco, bairro, cidade,cep, estado) values(?,?,?,?,?,?,?,?,?,?,?,?)";
		$this->typeDatabase->prepare($sql);
		$i = 1;
		foreach ($attributes as $attribute) {
			$this->typeDatabase->bindValue($i, $attribute);
			$i++;
		}
		return $this->typeDatabase->execute();
	}

	public function update(Array $attributes, $id) {
		$sql = "update {$this->table} set name = :name,sobrenome =:sobrenome,email=:email,ddd=:ddd,telefone=:telefone,endereco=:endereco,bairro=:bairro, cidade=:cidade,cep=:cep,estado=:estado where id = :id";

		$this->typeDatabase->prepare($sql);

		foreach ($attributes as $key => $attribute) {
			$this->typeDatabase->bindValue(":{$key}", $attribute);
		}

		$this->typeDatabase->bindValue(':id', $id[0]);

		$this->typeDatabase->execute();

		return $this->typeDatabase->rowCount();
	}

}
