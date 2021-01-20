<?php

namespace App\Repositories\Admin;

use App\Models\Admin\EstoqueModel;
use App\Repositories\Repository;

class EstoquesRepository extends Repository {

	public function __construct() {
		$this->model = new EstoqueModel;
	}

	public function listar() {
		$this->sql = "select estoque.id as idEstoque,produtos.id as idProduto,estoque_produto,produto_nome,produto_slug,estoque_quantidade from {$this->model->table} right join produtos on produtos.id = estoque.estoque_produto";

		return $this;
	}

	public function listaVendas() {
		$this->sql = "select produto_nome,name,valor,subtotal,produto_valor,quantidade,pedidos_produtos.id as idPedido, produtos.id as idProduto from {$this->model->table} inner join produtos on produtos.id = pedidos_produtos.produto inner join users on users.id = pedidos_produtos.user";

		return $this;
	}

}