Ï<?php

namespace App\Classes\Forms;

use App\Classes\Forms\Form;
use App\Models\Admin\CategoriaModel;

class CategoriaUpdate extends Form {

    protected $rules = [
        'categoria_nome' => 'required',
        'categoria_slug' => 'required',
    ];

    public function update($id) {
        if (!$this->validateWhitoutRepeat()) {
            $filter = $this->get('filters')->filterInputs('categoria_nome', 'categoria_slug');

            $atualizado = $this->load(CategoriaModel::class)->update($filter->all(), $id);

            if ($atualizado) {
                $this->get('flash')->add('mensagem_categoria', 'Atualizado com sucesso !!!', 'success');
                $this->get('persist')->removeInputs();
                return $this->get('redirect')->back();
            }

            $this->flash->add('mensagem_categoria', 'Erro ao atualizar, tente novamente');
            return $this->get('redirect')->back();
        }
        return $this->get('redirect')->back();
    }

}
