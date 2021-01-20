<?php

namespace App\Classes;

use App\Classes\Logado;
use App\Classes\Uri;

class Block {

	public function blockNotAdmin($class) {
		$reflection = new \ReflectionClass($class);
		$namespace = $reflection->getNamespaceName();

		$uri = (new Uri)->getUri();

		if ($namespace == 'App\Controllers\Admin' and $uri != '/admin') {
			Logado::adminLogado();
		}
	}

}