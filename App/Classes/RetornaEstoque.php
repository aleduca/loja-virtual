<?php

namespace App\Classes;

use App\Classes\Estoque;

class RetornaEstoque {

	private $estoque;

	public function __construct() {
		$this->estoque = new Estoque;
	}
}
