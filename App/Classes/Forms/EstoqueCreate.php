<?php

namespace App\Classes\Forms;

use App\Classes\Forms\Form;
use App\Models\Admin\EstoqueModel;

class EstoqueCreate extends Form {
	
	protected $rules = [
		'estoque_quantidade' => 'required',
	];
	
	public function create() {
		if (!$this->validateWhitoutRepeat($this->rules)) {
			$filter = $this->get('filters')->filterInputs('id','estoque_quantidade');
			
			$atualizado = $this->load(EstoqueModel::class)->create($filter->all());
			
			if ($atualizado) {
				return 'atualizado';
			}
			return 'erro';
		}
		return 'required';	
    }
}	