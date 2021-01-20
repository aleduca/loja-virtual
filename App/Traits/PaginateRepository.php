<?php
namespace App\Traits;

trait PaginateRepository {

	protected $paginate;

	public function paginate($perPage) {

		$this->perPage($perPage);

		$this->paginate = true;

		return $this;
	}

}