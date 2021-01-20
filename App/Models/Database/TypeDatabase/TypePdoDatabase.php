<?php

namespace App\Models\Database\TypeDatabase;

use App\Interfaces\InterfaceTypeDatabase;
use App\Models\Database\ConnectDatabase\Connection;
use App\Models\Database\ConnectDatabase\ConnectPdoDatabase;

class TypePdoDatabase implements InterfaceTypeDatabase {

	private $pdo;
	private $objectPdo;

	public function __construct() {
		$pdo = new Connection(new ConnectPdoDatabase);
		$this->pdo = $pdo->connectDatabase();
	}

	public function prepare($sql) {
		$this->objectPdo = $this->pdo->prepare($sql);
	}

	public function bindValue($key, $value) {
		$this->objectPdo->bindValue($key, $value);
	}

	public function execute() {
		return $this->objectPdo->execute();
	}

	public function rowCount() {
		return $this->objectPdo->rowCount();
	}

	public function fetch() {
		return $this->objectPdo->fetch();
	}

	public function fetchAll() {
		return $this->objectPdo->fetchAll();
	}

	public function commit() {
		return $this->pdo->commit();
	}

	public function beginTransaction() {
		return $this->pdo->beginTransaction();
	}

	public function rollback() {
		return $this->pdo->rollback();
	}

	public function getBind() {
		return $this->objectPdo;
	}

}