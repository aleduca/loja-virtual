<?php

namespace App\Classes;

use App\Classes\Uri;

class BreadCrumb {

	private $uri;

	public function __construct() {
		$uri = new Uri;
		$this->uri = $uri->getUri();
	}

	private function breadCrumbHome() {
		return "<span style='color:#000;'>Navegação</span>: <span>Início</span>";
	}

	private function redefinirSenha() {
		$explode = array_filter(explode('/', $this->uri));

		if ($explode[1] == 'esqueci' && $explode[2] == 'senha') {
			return true;
		}

		return false;
	}

	private function breadCrumbOtherPages() {

		if ($this->redefinirSenha()) {
			return "<span style='color:#000;'>Navegação</span>: <span> <a href='/' style='text-decoration:none;color:blue;'>Início</a><span class='seperator'> &nbsp; </span>esqueci<span class='seperator'> &nbsp; </span>senha</span>";
		}

		$formatBreadCrumb = str_replace("/", "<span class='seperator'> &nbsp; </span>", $this->uri);

		return "<span style='color:#000;'>Navegação</span>: <span> <a href='/' style='text-decoration:none;color:blue;'>Início</a>" . $formatBreadCrumb . '</span>';
	}

	private function breadCrumbSearch() {
		$explodeIgual = explode('=', $this->uri);
		return "<span style='color:#0000;'> Você está buscando:</span> <span>" . str_replace('+', '-', $explodeIgual[1]) . "<span>";
	}

	public function createBreadCrumb() {

		if ($this->uri == '/') {
			return $this->breadCrumbHome();
		}

		if (substr_count($this->uri, '?') > 0) {
			return $this->breadCrumbSearch();
		}

		return $this->breadCrumbOtherPages();

	}
}