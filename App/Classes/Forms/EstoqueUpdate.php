<?php

namespace App\Classes\Forms;

use App\Classes\Forms\Form;
use App\Models\Admin\EstoqueModel;

class EstoqueUpdate extends Form {

	protected $rules = [
		'estoque_quantidade' => 'required',
	];

	public function update() {
		if (!$this->validateWhitoutRepeat()) {
			$filter = $this->get('filters')->filterInputs('estoque_quantidade', 'id');

			$atualizado = $this->load(EstoqueModel::class)->update($filter->get('id'), $filter->get('estoque_quantidade'));

			if ($atualizado) {
				return 'atualizado';
			}
			return 'erro';
		}
		return 'required';
	}

}
