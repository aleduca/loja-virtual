<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Repositories\Admin\PedidosRepository;

class AdminVendasMesController extends BaseController{
   public function index(){

    $pedidos = new PedidosRepository;
    $pedidosEncontrados = $pedidos->listaVendasMes();

    $dados = [
        'titulo' => 'Lista de vendas do mes',
        'pedidos' => $pedidosEncontrados
    ];

    $template = $this->twig->loadTemplate('admin_listar_vendas_mes.html');

    $template->display($dados);    
    } 
}