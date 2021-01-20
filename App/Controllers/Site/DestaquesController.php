<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Repositories\Site\ProdutoRepository;

class DestaquesController extends BaseController {

    public function index() {
        $produtoRepository = new ProdutoRepository();
        $produtosDestaque = $produtoRepository->listarProdutosEmDestaque();

        $dados = [
            'titulo' => 'Produtos em destaque',
            'produtos' => $produtosDestaque
        ];
        
        $template = $this->twig->loadTemplate('site_destaques.html');
        $template->display($dados);
    }

}
