<?php

namespace App\Repositories\Admin;

use App\Models\Admin\ProdutoModel;
use App\Repositories\Repository;

class ProdutosRepository extends Repository {

	public $model;

	public $sql;

	public function __construct() {
		$this->model = new ProdutoModel;
	}

	public function listarProdutos() {
		$this->sql = "select *, produtos.id as idProduto from {$this->model->table} inner join categorias on categorias.id = produto_categoria";

		return $this;
	}

	public function atualizarCapa($capa, $id) {
		$sql = "update {$this->model->table} set produto_foto = ? where id = ?";
		$this->model->typeDatabase->prepare($sql);
		$this->model->typeDatabase->bindValue(1, $capa);
		$this->model->typeDatabase->bindValue(2, $id);
		return $this->model->typeDatabase->execute();
	}

	public function updateValorPromocao($promocao, $id) {
		$sql = "update {$this->model->table} set produto_valor_promocao = ? where id = ?";
		$this->model->typeDatabase->prepare($sql);
		$this->model->typeDatabase->bindValue(1, $promocao);
		$this->model->typeDatabase->bindValue(2, $id);
		return $this->model->typeDatabase->execute();
	}

	public function updatePromocao($status, $id) {
		$sql = "update {$this->model->table} set produto_promocao = ? where id = ?";
		$this->model->typeDatabase->prepare($sql);
		$this->model->typeDatabase->bindValue(1, $status);
		$this->model->typeDatabase->bindValue(2, $id);
		return $this->model->typeDatabase->execute();
	}

	public function updateDestaque($status, $id) {
		$sql = "update {$this->model->table} set produto_destaque = ? where id = ?";
		$this->model->typeDatabase->prepare($sql);
		$this->model->typeDatabase->bindValue(1, $status);
		$this->model->typeDatabase->bindValue(2, $id);
		return $this->model->typeDatabase->execute();
	}

	public function updatePresente($status, $id) {
		$sql = "update {$this->model->table} set produto_presente = ? where id = ?";
		$this->model->typeDatabase->prepare($sql);
		$this->model->typeDatabase->bindValue(1, $status);
		$this->model->typeDatabase->bindValue(2, $id);
		return $this->model->typeDatabase->execute();
	}

}
