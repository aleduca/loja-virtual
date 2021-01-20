<?php

namespace App\Repositories\Admin;

use App\Models\Site\CategoriaModel;
use App\Repositories\Repository;

class CategoriaRepository extends Repository {

	public function __construct() {
		$this->model = new CategoriaModel;
	}

}