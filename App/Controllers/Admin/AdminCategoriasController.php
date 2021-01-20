<?php

namespace App\Controllers\Admin;

use App\Classes\Forms\CategoriaCreate;
use App\Classes\Forms\CategoriaUpdate;
use App\Controllers\BaseController;
use App\Models\Admin\CategoriaModel;
use App\Repositories\Admin\CategoriaRepository;

class AdminCategoriasController extends BaseController {

	public function index() {

		$categoria = $this->load(CategoriaRepository::class);

		if (isset($_GET['s'])) {
			$categoriasEncontradas = $categoria->select('*')->busca(['categoria_nome'])->paginate(15)->get();
		} else {
			$categoriasEncontradas = $categoria->select('*')->paginate(15)->get();
		}

		$template = $this->view([
			'titulo' => 'Lista de Categorias',
			'categorias' => $categoriasEncontradas,
			'links' => $categoria->links(),
		], 'admin_listar_categorias');

	}

	public function edit($id) {

		$id = filter_var($id[0], FILTER_SANITIZE_STRING);

		$categorias = $this->load(CategoriaModel::class);
		$categoriaEncontrada = $categorias->find('id', $id);

		$template = $this->view([
			'titulo' => 'Lista de Categorias',
			'categoria' => $categoriaEncontrada,
		], 'admin_form_editar_categoria');

	}

	public function create() {
		$this->view([
			'titulo' => 'Cadastrar Categoria',
		], 'admin_form_cadastrar_categoria');
	}

	public function store() {
		if ($this->request->request('post')) {
			$categoriaForm = new CategoriaCreate;
			$categoriaForm->create();
		}
	}

	public function update($id) {
		if ($this->request->request('post')) {
			$id = filter_var($id[0], FILTER_SANITIZE_STRING);
			$categoriaUpdate = new CategoriaUpdate;
			$categoriaUpdate->update($id);
		}
	}

	public function destroy($id) {
		$id = filter_var($id[0], FILTER_SANITIZE_NUMBER_INT);
		$this->load(CategoriaModel::class)->delete('id', $id);

		return $this->get('redirect')->back();
	}
}