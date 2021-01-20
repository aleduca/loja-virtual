<?php

namespace App\Repositories\Site;

use App\Models\Site\CategoriaModel;
use App\Repositories\Repository;

class CategoriasRepository extends Repository {

	public function __construct() {
		$this->model = new CategoriaModel;
	}
}