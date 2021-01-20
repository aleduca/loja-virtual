<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\PedidosModel;
use App\Models\Admin\PedidosProdutosModel;
use App\Models\Admin\ProdutoModel;

class AdminPedidosProdutosController extends BaseController{
    
    public function index(){
       
        $id = filter_input(INPUT_POST,'id', FILTER_SANITIZE_NUMBER_INT);

        $pedidos = new PedidosModel;        
        $pedidoEncontrado = $pedidos->find('id',$id)->sessao;

        $pedidosProdutos = new PedidosProdutosModel;
        $produtosEncontrados = $pedidosProdutos->find('sessao',$pedidoEncontrado,'all');

        $produtos['produtos'] = [];
        $produtos['quantidade'] = [];

        $produtoModel = new ProdutoModel;
        foreach($produtosEncontrados as $produto){
                $produtosEncontradosPedido = $produtoModel->find('id',$produto->produto);
                array_push($produtos['produtos'], $produtosEncontradosPedido);
                $produtos['quantidade'][$produtosEncontradosPedido->id] = $produto->quantidade;
        }

        echo json_encode($produtos);

    }

}