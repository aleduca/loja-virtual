<?php

namespace App\Repositories\Admin;

use App\Models\Admin\UserModel;
use App\Repositories\Repository;

class ClientesRepository extends Repository {

	protected $model;

	public function __construct() {
		$this->model = new UserModel;
	}

	// public function clientes() {
	// 	$this->sql = "select * from {$this->model->table} ";

	// 	return $this;
	// }

}