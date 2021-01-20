<?php

namespace App\Classes;

use App\Classes\PersistInput;
use App\Classes\TypesValidation;

class Validate {

	private $rules;

	public function __construct($rules) {
		$this->rules = $rules;
	}

	private function callMethodAndPersist($validateMethod, $field) {

		PersistInput::add($field);

		if (!is_array($validateMethod)) {
			TypesValidation::$validateMethod($field);
			return;
		}

		foreach ($validateMethod as $method) {
			TypesValidation::$method($field);
		}
	}

	public function validate() {
		foreach ($this->rules as $field => $method) {

			if (substr_count($method, ':') > 0) {
				$method = strstr($method, ':', true);
			}

			if (substr_count($method, '|') > 0) {
				$method = explode('|', $method);
			}

			$this->callMethodAndPersist($method, $field);
		}
	}
}
