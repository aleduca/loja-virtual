<?php

namespace App\Controllers\site;

use App\Classes\Cache;
use App\Classes\Redis;
use App\Controllers\BaseController;
use App\Repositories\Site\ProdutoRepository;

class PresentesController extends BaseController {

    public function index() {

        $cache = new Cache(new Redis($this->cache));

        $produtoRepository = new ProdutoRepository;

        $cache->set('produtos_presentes',$produtoRepository->listarProdutoParaPresentes());
        
        $produtosParaPresentes = $cache->get('produtos_presentes'); 

        $cache->expire('produtos_presentes');

        $dados = [
            'titulo' => 'Curso PHPOO AWB | Produtos para Presentes',
            'produtos' => $produtosParaPresentes
        ];

        $template = $this->twig->loadTemplate('site_presentes.html');
        $template->display($dados);
    }

}
