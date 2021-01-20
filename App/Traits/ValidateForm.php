<?php

namespace App\Traits;

use App\Classes\RepeatedRegisters;
use App\Classes\Validate;

trait ValidateForm {

	private function validateFields() {
		return $this->load(Validate::class, $this->rules)->validate();
	}

	protected function validateWithRepeat() {
		$this->validateFields();
		$this->load(RepeatedRegisters::class, $this->rules)->validate();

		// Agora sempre que precisar mudar o nome do metodo para verificar o erro, é só mudar aqui, nao preciso ir em todos os controllers e mudar
		return $this->get('error')->hasError();
	}

	protected function validateWhitoutRepeat() {
		$this->validateFields();
		return $this->get('error')->hasError();
	}
}