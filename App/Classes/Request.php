<?php

namespace App\Classes;

class Request {

	public static function request($type) {
		return ($_SERVER['REQUEST_METHOD'] == strtoupper($type));
	}

}