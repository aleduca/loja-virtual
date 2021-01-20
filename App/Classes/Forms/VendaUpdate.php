<?php

namespace App\Classes\Forms;

use App\Classes\Forms\Form;
use App\Models\Admin\PedidosProdutosModel;

class VendaUpdate extends Form {

	protected $rules = [
		'quantidade' => 'required',
		'valor' => 'required',
		'subtotal' => 'required',
	];

	public function update($id) {
		if (!$this->validateWhitoutRepeat()) {
			$filter = $this->get('filters')->filterInputs('quantidade', 'valor', 'subtotal');
			$atualizado = $this->load(PedidosProdutosModel::class)->update($filter->all(), $id);
			if ($atualizado) {
				$this->get('flash')->add('message', 'Pedido atualizado com sucesso !!', 'success');
				$this->get('persist')->removeInputs();
				return $this->get('redirect')->back();
			}
			$this->get('flash')->add('message', 'Erro ao atualizar pedido, tente novamente !!');
			return $this->get('redirect')->back();
		}
		return $this->get('redirect')->back();
	}

}