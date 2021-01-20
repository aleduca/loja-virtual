<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\ProdutoModel;
use App\Repositories\Admin\ProdutosRepository;

class AdminProdutosPromocaoController extends BaseController{
    
    public function index(){

        $promocao = filter_input(INPUT_POST,'promocao',FILTER_SANITIZE_STRING);
        $id = filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT);

        $produto = new ProdutoModel;
        $produtoEncontrado = $produto->find('id',$id);

        $produtosRepository = new ProdutosRepository;        
        if($produtoEncontrado->produto_promocao == 1){
            $produtosRepository->updatePromocao(2,$id);
        }

        if($produtoEncontrado->produto_promocao == 2){
            $produtosRepository->updatePromocao(1,$id);
            $produtosRepository->updateValorPromocao($promocao,$id);
        }

        echo 'updated';

    }

}