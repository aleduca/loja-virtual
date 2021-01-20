<?php

namespace App\Repositories\Admin;

use App\Models\Admin\PedidosProdutosModel;
use App\Repositories\Repository;

class PedidosProdutosRepository extends Repository {

	protected $model;

	public function __construct() {
		$this->model = new PedidosProdutosModel;
	}

	public function listaVendas() {
		$this->sql = "select produto_nome,name,valor,subtotal,produto_valor,quantidade,pedidos_produtos.id as idPedido, produtos.id as idProduto from {$this->model->table} inner join produtos on produtos.id = pedidos_produtos.produto inner join users on users.id = pedidos_produtos.user";

		return $this;
	}

}