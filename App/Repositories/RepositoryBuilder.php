<?php

namespace App\Repositories;

use App\Classes\Bind;
use App\Traits\Paginate;

class RepositoryBuilder {

	use Paginate;

	protected $select;

	protected $busca;

	protected $limite;

	protected $paginate;

	protected $order;

	public function select($select) {

		$this->select = $select;

		return $this;

	}

	public function busca($busca) {
		$this->busca = $busca;

		return $this;
	}

	public function limit($limite) {
		$this->limite = $limite;

		return $this;
	}

	public function orderBy(array $order) {
		if (!is_array($order)) {
			throw new \Exception("O argumento passado para o order deve ser um array");
		}

		$this->order = $order;

		return $this;
	}

	public function paginate($perPage) {

		$this->perPage($perPage);

		$this->paginate = true;

		return $this;
	}

	protected function createAndExecuteSql() {

		$sql = $this->mountSql();

		$this->model->typeDatabase->prepare($sql);

		$this->binds();

		$this->bindIfSearch();

		$this->model->typeDatabase->execute();
	}

	private function bindIfSearch() {
		if (isset($this->busca)) {
			$busca = filter_var($_GET['s'], FILTER_SANITIZE_STRING);
			$this->model->typeDatabase->bindValue(":{$this->busca[0]}", '%' . $busca . '%');
		}
	}

	private function binds() {
		if (isset($this->binds)) {
			foreach ($this->binds as $key => $value) {
				$this->model->typeDatabase->bindValue(":{$key}", $value);
			}
		}
	}

	private function mountSql() {

		if (isset($this->sql)) {
			$sql = $this->sql;
		}

		if (isset($this->select)) {
			$sql = "select {$this->select} from {$this->model->table}";
		}

		if (isset($this->busca)) {
			$sql .= " where {$this->busca[0]} like :{$this->busca[0]}";
		}

		if (isset($this->limite)) {
			$sql .= " limit {$this->limite}";
		}

		if (isset($this->order)) {
			$sql .= " order by {$this->order[0]} {$this->order[1]}";
		}

		if ($this->paginate) {
			$this->totalRecordsToPaginate($sql);
			$sql .= " {$this->sqlPaginate()}";
		}

		return $sql;
	}

	private function totalRecordsToPaginate($sql) {
		$this->model->typeDatabase->prepare($sql);
		$this->binds();
		$this->bindIfSearch();
		$this->model->typeDatabase->execute();
		Bind::bind('bind', $this->model->typeDatabase->getBind());
	}

}
