<?php


namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\ProdutoModel;
use App\Repositories\Admin\ProdutosRepository;

class AdminProdutosDestaqueController extends BaseController{
    
    public function index(){
        $id = filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT);

        $produto = new ProdutoModel;
        $produtoEncontrado = $produto->find('id',$id);

        $status = ($produtoEncontrado->produto_destaque == 1) ? 2 : 1;

        $produtosRepository = new ProdutosRepository;
        $atualizado = $produtosRepository->updateDestaque($status,$id);

        if($atualizado){
            echo 'updated';
        }

    }

}