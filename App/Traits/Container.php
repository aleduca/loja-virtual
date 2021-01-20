<?php

namespace App\Traits;

use App\Classes\Block;
use App\Classes\ErrorsValidate;
use App\Classes\FlashMessage;
use App\Classes\MassFilter;
use App\Classes\PersistInput;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\SendEmail;

trait Container {

	private $container = [];

	private $classes = [
		'redirect' => Redirect::class,
		'flash' => FlashMessage::class,
		'filters' => MassFilter::class,
		'email' => SendEmail::class,
		'request' => Request::class,
		'block' => Block::class,
		'persist' => PersistInput::class,
		'error' => ErrorsValidate::class,
	];

	public function initContainer() {
		foreach ($this->classes as $index => $class) {
			if (!isset($this->container[$index])) {
				$this->container[$index] = new $class;
			}
		}
	}

	public function get($key) {
		if (!isset($this->container[$key])) {
			throw new \Exception("Esse serviço não existe no container {$key}");
		}

		if (isset($this->container[$key])) {
			return $this->container[$key];
		}
	}

	public function __get($index) {
		if (!property_exists($this, $index)) {
			return $this->get($index);
		}
	}

	public function load($class, $construct = null) {
		if (!class_exists($class)) {
			throw new \Exception("Essa classe não existe {$class}");
		}
		return ($construct == null) ? new $class() : new $class($construct);
	}

}