<?php

if (preg_match('/\.(?:png|jpg|jpeg|gif)$/', $_SERVER["REQUEST_URI"])) {
	return false;
} else {

	define('DEFAULT_CONTROLLER', 'home');
	define('DEFAULT_METHOD', 'index');

	require '../vendor/autoload.php';
	require '../App/Functions/helpers.php';
	require 'bootstrap/bootstrap.php';

}