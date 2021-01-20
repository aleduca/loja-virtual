<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Models\Site\PedidosModel;
use App\Repositories\Site\PedidosProdutosRepository;

class PedidosController extends BaseController{

	public function show($params){
		
		$pedidosModel = new PedidosModel;
		$dadosPedido = $pedidosModel->find('id',$params[0]);

		$pedidosProdutos = new PedidosProdutosRepository;
		$dadosPedidos = $pedidosProdutos->pedidos($dadosPedido->pedido_user, $dadosPedido->sessao);

		$pedido = $pedidosProdutos->produtosPedido($dadosPedidos);

		echo json_encode($pedido);

	}
	
}