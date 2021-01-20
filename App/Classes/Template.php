<?php

namespace App\Classes;

class Template {

	private function loader() {
		$folderView = realpath(__DIR__ . '/..');
		return new \Twig_Loader_Filesystem([$folderView . '/Views/site', $folderView . '/Views/admin']);
	}

	public function init() {
		return new \Twig_Environment($this->loader(), [
			'debug' => true,
			// 'cache' => ''
			'auto_reload' => true,
		]);
	}

}