<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class AdminController extends BaseController {

	public function index() {
		$this->view([
			'titulo' => 'Login do administrador',
		], 'admin_login');
	}

}