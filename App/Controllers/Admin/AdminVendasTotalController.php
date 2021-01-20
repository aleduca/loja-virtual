<?php

namespace App\Controllers\Admin;    

use App\Controllers\BaseController;
use App\Repositories\Admin\PedidosRepository;

class AdminVendasTotalController extends BaseController{
    
    public function index(){

        $pedidos = new PedidosRepository;
        $pedidosEncontrados = $pedidos->listaVendas();

        $dados = [
            'titulo' => 'Curso PHPOO AWB | Lista de vendas',
            'pedidos' => $pedidosEncontrados
        ];

        $template = $this->twig->loadTemplate('admin_listar_vendas_total.html');
        $template->display($dados); 
    }

}