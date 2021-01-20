<?php

namespace App\Repositories\Admin;

use App\Models\Admin\UserModel;
use App\Repositories\Repository;

class UsersRepository extends Repository{
	
	protected $model;
	
	public function __construct(){
		$this->model = new UserModel;
	}
	
	public function listaUsers(){
		$this->sql = "select * from {$this->model->table}";
		
		return $this;
	}
	
	
}
