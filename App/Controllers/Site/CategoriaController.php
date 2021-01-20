<?php

namespace App\Controllers\Site;

use App\Classes\Redirect;
use App\Controllers\BaseController;
use App\Models\Site\CategoriaModel;
use App\Models\Site\ProdutoModel;

class CategoriaController extends BaseController {

	public function index($params) {
		$categoriaModel = new CategoriaModel;
		$categoriaEncontrada = $categoriaModel->find('categoria_slug', $params[1]);

		$redirect = new Redirect;
		if (!$categoriaEncontrada) {
			$redirect->redirect('/');
		}

		$produtoModel = new ProdutoModel();
		$produtosEncontrados = $produtoModel->find('produto_categoria', $categoriaEncontrada->id, 'all');

		$dados = [
			'titulo' => 'Curso PHPOO AWB | Home',
			'produtos' => $produtosEncontrados,
			'categoria' => $categoriaEncontrada,
		];

		$this->view($dados, 'categoria');
	}

}
