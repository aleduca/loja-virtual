<?php

namespace App\Classes;

class PersistInput {

	public static function add($value) {
		if (!isset($_SESSION['persist'][$value])) {
			$_SESSION['persist'][$value] = $_POST[$value];
		}
	}

	public static function show($value) {
		if (isset($_SESSION['persist'][$value])) {
			$persist = $_SESSION['persist'][$value];
		}
		self::removeInput($value);
		return $persist ?? '';
	}

	private static function removeAll($value) {
		unset($_SESSION['persist'][$value]);
	}

	public static function removeInputs() {
		unset($_SESSION['persist']);
	}

}
