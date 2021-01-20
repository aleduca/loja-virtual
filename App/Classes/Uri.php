<?php

namespace App\Classes;

class Uri {

	private $uri;

	public function __construct() {
		$this->uri = $_SERVER['REQUEST_URI'];
	}

	public function emptyUri() {
		return ($this->uri == '/') ? true : false;
	}

	public function getUri() {
		return parse_url($this->uri, PHP_URL_PATH);
	}

}