<?php

namespace App\Classes;

class RepeatedRegisters {

	protected $model;

	protected $field;

	protected $rules;

	public function __construct($rules) {
		$this->rules = $rules;
	}

	private function getModelAndField() {
		foreach ($this->rules as $field => $rule) {
			if (substr_count($rule, ':') > 0) {
				list($validate, $model) = explode(":", $rule);
				$this->model = $model;
				$this->field = $field;
			}
		}

		return [
			'model' => new $this->model,
			'field' => $this->field,
		];
	}

	public function validate() {
		$modelAndField = $this->getModelAndField();

		if ($modelAndField['model']->find($modelAndField['field'], $_POST[$modelAndField['field']])) {
			ErrorsValidate::add($modelAndField['field'], 'Já existe um registro cadastrado com esse valor');
		}
	}
}