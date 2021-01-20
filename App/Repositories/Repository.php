<?php

namespace App\Repositories;

use App\Repositories\RepositoryBuilder;

abstract class Repository extends RepositoryBuilder {

	public function get() {
		$this->createAndExecuteSql();
		return $this->model->typeDatabase->fetchAll();
	}

	public function first() {
		$this->createAndExecuteSql();
		return $this->model->typeDatabase->fetch();
	}

}
