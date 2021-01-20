<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Repositories\Site\ProdutoRepository;

class HomeController extends BaseController {

	public function index() {

		$produtoRepository = new ProdutoRepository;
		$produtosDestaque = $produtoRepository->byLast(5)->get();

		$this->view([
			'titulo' => 'Curso PHPOO | Loja Virtual',
			'produtos' => $produtosDestaque,
		], 'home');
	}

}
