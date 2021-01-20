<?php

use App\Classes\Container;
use App\Classes\FlashMessage;
use App\Classes\IdRandom;
use App\Classes\Redirect;

function idRandom() {
	return IdRandom::generateId();
}

function dd($dump) {
	var_dump($dump);
	die();
}

function validate($value, $type) {
	switch ($type) {
	case 'string':
		return filter_var($_POST[$value], FILTER_SANITIZE_STRING);
		break;
	case 'int':
		return filter_var($_POST[$value], FILTER_SANITIZE_NUMBER_INT);
		break;
	case 'email':
		return filter_var($_POST[$value], FILTER_SANITIZE_EMAIL);
		break;
	}
}

function flash($index, $message, $typeMessage) {
	return FlashMessage::add($index, $message, $typeMessage);
}

function redirect($to) {
	return Redirect::redirect('/adminClientes/create');
}

function back() {
	return Redirect::back();
}

// Melhor utilizar o outro jeito, no basecontroller
// se chamar assim vai ter que carregar todas as classes a cada chamada do get no basecontroller vai ser chamado uma vez só no construct
function get($index) {
	$container = new Container;
	$container->initContainer();
	return $container->get($index);
}