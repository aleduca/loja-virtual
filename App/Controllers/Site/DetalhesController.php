<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Models\Site\ProdutoModel;

class DetalhesController extends BaseController {

	private $produto;

	public function __construct() {
		$this->produto = new ProdutoModel;
	}

	public function index($params) {

		$produtoEncontrado = $this->produto->find('produto_slug', $params[0]);

		$dados = [
			'titulo' => 'Detalhes do produto ' . $produtoEncontrado->produto_nome,
			'produto' => $produtoEncontrado,
		];

		$this->view($dados, 'detalhes');
	}

}
