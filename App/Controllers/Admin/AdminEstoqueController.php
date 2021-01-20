<?php

namespace App\Controllers\Admin;

use App\Classes\Forms\EstoqueUpdate;
use App\Classes\Forms\EstoqueCreate;
use App\Controllers\BaseController;
use App\Repositories\Admin\EstoquesRepository;
use App\Models\Admin\EstoqueModel;

class AdminEstoqueController extends BaseController {

	public function index() {

		$estoque = $this->load(EstoquesRepository::class);
		if(isset($_GET['s'])){
			$estoquesEncontrados = $estoque->listar()->busca(['produto_nome'])->paginate(15)->get();
		}else{
			$estoquesEncontrados = $estoque->listar()->paginate(15)->get();
		}

		$this->view([
			'titulo' => 'Lista de produtos com estoque',
			'estoques' => $estoquesEncontrados,
		], 'admin_listar_estoque');
	}

	public function update() {

		$estoqueEncontrado = $this->load(EstoqueModel::class)->find('estoque_produto',$_POST['id']);

		if(!$estoqueEncontrado){
			$estoque = new EstoqueCreate;
			echo $estoque->create();
		}else{
			$estoque = new EstoqueUpdate;
			echo $estoque->update($_POST);

		}

	}

}