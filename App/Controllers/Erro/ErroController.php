<?php

namespace App\Controllers\Erro;

use App\Controllers\BaseController;

class ErroController extends BaseController {
	public function index() {
		dd('Erro');
	}

	public function erro503() {
		dd(503);
	}
}