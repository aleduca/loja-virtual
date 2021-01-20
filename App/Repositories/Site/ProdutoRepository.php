<?php

namespace App\Repositories\Site;

use App\Models\Site\ProdutoModel;
use App\Repositories\Repository;

class ProdutoRepository extends Repository {

	protected $model;
	protected $binds;

	public function __construct() {
		$this->model = new ProdutoModel;
	}

	public function byLast() {
		$this->sql = "select produtos.id as idProduto,produto_slug,produto_foto,produto_nome,categoria_nome,categoria_slug,produto_promocao,produto_valor_promocao,produto_valor from {$this->model->table}
        inner join categorias on categorias.id = produto_categoria
        order by produtos.id DESC";
		return $this;
	}

	public function byCategory($category) {
		$this->sql = "select produtos.id as idProduto,produto_slug,produto_foto,produto_nome,categoria_nome,produto_promocao,produto_valor_promocao,produto_valor from {$this->model->table}
            inner join categorias on categorias.id = produto_categoria where produto_categoria = :produto_categoria
            order by produtos.id DESC";

		$this->binds = [
			'produto_categoria' => $category,
		];

		return $this;
	}

}
