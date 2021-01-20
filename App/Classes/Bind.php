<?php

namespace App\Classes;

class Bind {

	private static $bind = [];

	public static function bind($key, $value) {
		static::$bind[$key] = $value;
	}

	public static function get($key) {
		return static::$bind[$key];
	}

}