<?php
namespace App\Traits;

trait PaginateModel {

	public function paginate($perPage) {

		$this->perPage($perPage);

		$sql = "select * from {$this->table} {$this->Sqlpaginate()}";

		$this->typeDatabase->prepare($sql);

		$this->typeDatabase->execute();

		return $this->typeDatabase->fetchAll();
	}

}