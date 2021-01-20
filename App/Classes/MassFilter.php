<?php

namespace App\Classes;

use App\Classes\Filters;

class MassFilter extends Filters {

	private $object = [];

	private function setObject($key, $value) {
		$this->object[$key] = $value;
	}

	public function filterInputs(...$fields) {
		foreach ($fields as $value) {
			$explode = explode(':', $value);
			$type = $explode[1] ?? 'string';
			$this->setObject($explode[0], $this->filter($explode[0], $type));
		}
		return $this;
	}

	public function get($key) {
		return $this->object[$key];
	}

	public function all($passwordEncrypt = null) {
		if ($passwordEncrypt == true) {
			$hash = Password::hash($this->get('password'));
			$this->object['password'] = filter_var($hash, FILTER_SANITIZE_STRING);
		}
		return $this->object;
	}

}