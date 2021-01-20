<?php
namespace App\Models\Database\querybuilder;

class SelectQueryBuilder {

	private function createSql($object, $paginate = null) {

		$sql = $object->sql;

		if (isset($object->select)) {
			$sql = "select {$object->select} from {$object->model->table}";
		}

		if (isset($object->busca)) {
			$sql .= " where {$object->busca[0]} like :{$object->busca[0]}";
		}

		if ($paginate) {
			$sql .= " {$object->Sqlpaginate()}";
		}

		$object->model->typeDatabase->prepare($sql);

		if (isset($object->busca)) {
			$busca = filter_var($_GET['s'], FILTER_SANITIZE_STRING);
			$object->model->typeDatabase->bindValue(":{$object->busca[0]}", '%' . $busca . '%');
		}
	}

	public static function create($object, $paginate = null) {
		return (new Static )->createSql($object, $paginate);
	}

}