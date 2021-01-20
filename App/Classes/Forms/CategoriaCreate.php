<?php

namespace App\Classes\Forms;

use App\Classes\Forms\Form;
use App\Models\Admin\CategoriaModel;

class CategoriaCreate extends Form {

	protected $rules = [
		'categoria_nome' => 'required',
		'categoria_slug' => 'required:' . CategoriaModel::class,
	];

	public function create() {
		if (!$this->validateWithRepeat()) {
			$filter = $this->get('filters')->filterInputs('categoria_nome', 'categoria_slug');
			$cadastrado = $this->load(CategoriaModel::class)->create($filter->all());
			if ($cadastrado) {
				$this->get('flash')->add('message', 'Categoria cadastrada com sucesso !!', 'success');
				$this->get('persist')->removeAll();
				return $this->get('redirect')->back();
			}
			$this->get('flash')->add('message', 'Erro ao cadastrar categoria, tente novamente !!');
			return $this->get('redirect')->back();
		}
		return $this->get('redirect')->back();
	}

}