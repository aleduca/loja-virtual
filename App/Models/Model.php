<?php

namespace App\Models;

use App\Classes\Bind;
use App\Models\Database\TypeDatabase\TypeDatabase;
use App\Models\Database\TypeDatabase\TypePdoDatabase;
use App\Traits\Paginate;
use App\Traits\PaginateModel;

abstract class Model {

	use Paginate, PaginateModel;

	private $fields;

	public $typeDatabase;

	public function __construct() {
		$database = new TypeDatabase(new TypePdoDatabase);
		$this->typeDatabase = $database->getDatabase();
	}

	public function fetchAll($paginate = null) {

		$sql = "select * from {$this->table}";

		$this->typeDatabase->prepare($sql);

		$this->typeDatabase->execute();

		Bind::bind('bind', $this->typeDatabase->getBind());

		if ($paginate) {
			return $this;
		}

		return $this->typeDatabase->fetchAll();
	}

	public function find($field, $value, $fetch = null) {
		$sql = "select * from {$this->table} where $field = ?";
		$this->typeDatabase->prepare($sql);
		$this->typeDatabase->bindValue(1, $value);
		$this->typeDatabase->execute();
		return ($fetch == null) ? $this->typeDatabase->fetch() : $this->typeDatabase->fetchAll();
	}

	public function findWithFields($field, $value, $fields) {
		$sql = "select {$fields} from {$this->table} where $field = ?";
		$this->typeDatabase->prepare($sql);
		$this->typeDatabase->bindValue(1, $value);
		$this->typeDatabase->execute();
		return $this->typeDatabase->fetch();
	}

	public function limit($limite) {
		$sql = "select * from {$this->table} limit {$limite}";
		$this->typeDatabase->prepare($sql);
		$this->typeDatabase->execute();
		return $this->typeDatabase->fetchAll();
	}

	public function delete($field, $value) {
		$sql = "delete from {$this->table} where $field = ?";
		$this->typeDatabase->prepare($sql);
		$this->typeDatabase->bindValue(1, $value);
		return $this->typeDatabase->execute();
	}
}
