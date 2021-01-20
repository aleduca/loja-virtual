<?php
namespace App\Controllers\Admin;

use App\Classes\ErrorsValidate;
use App\Classes\FlashMessage;
use App\Classes\MassFilter;
use App\Classes\Redirect;
use App\Classes\RepeatRegistersAdmin;
use App\Classes\Validate;
use App\Controllers\BaseController;
use App\Models\Admin\CategoriaModel;
use App\Models\Admin\MarcaModel;
use App\Models\Admin\ProdutoModel;
use App\Repositories\Admin\ProdutosRepository;

class AdminProdutosController extends BaseController {

	public function index() {

		$produtos = new ProdutosRepository;

		if (isset($_GET['s'])) {
			$produtosEncontrados = $produtos->select('*')->busca(['produto_nome'])->paginate(15)->get();
		} else {
			$produtosEncontrados = $produtos->listarProdutos()->paginate(15)->get();
		}

		$template = $this->view([
			'titulo' => 'Lista de produtos',
			'produtos' => $produtosEncontrados,
			'links' => $produtos->links(),
		], 'admin_listar_produtos');

	}

	public function create() {

		$categoria = new CategoriaModel;
		$categoriasEncontradas = $categoria->fetchAll();

		$marca = new MarcaModel;
		$marcasEncontradas = $marca->fetchAll();

		$template = $this->view([
			'titulo' => 'Cadastrar produto',
			'categorias' => $categoriasEncontradas,
			'marcas' => $marcasEncontradas,
		], 'admin_form_cadastrar_produto');
	}

	public function store() {
		if ($this->get('request')->request('post')) {

			$rules = [
				'produto_nome' => 'required',
				'produto_slug' => 'required:produto',
				'produto_valor' => 'required',
				'produto_categoria' => 'required',
				'produto_marca' => 'required',
				'produto_garantia' => 'required',
				'produto_descricao' => 'required',
			];

			$validate = new Validate($rules);
			$validate->validate()->repeatedRegisters(new RepeatRegistersAdmin);

			if (!$this->get('errors')->erroValidacao()) {
				$filter = $this->get('filters')->filterInputs('produto_nome', 'produto_slug', 'produto_valor', 'produto_categoria', 'produto_marca', 'produto_garantia', 'produto_descricao');

				if ((new ProdutoModel)->create($filter->all())) {
					$this->get('flash')->add('mensagem_produto', 'Cadastrado com sucesso !!!', 'success');
					$this->get('persist')->removeInputs();
					return $this->get('redirect')->back();
				}
				$this->get('flash')->add('mensagem_produto', 'Erro ao cadastrar, tente novamente');
				return $this->get('redirect')->back();
			}
			return $this->get('redirect')->back();
		}
	}

	public function edit($args) {

		$id = filter_var($args[0], FILTER_SANITIZE_NUMBER_INT);

		$produtosModel = new ProdutoModel;
		$produtoEncontrado = $produtosModel->find('id', $id);

		$categorias = new CategoriaModel;
		$categoriasEncontradas = $categorias->fetchAll();

		$marcas = new MarcaModel;
		$marcasEncontradas = $marcas->fetchAll();

		$dados = [
			'titulo' => 'Editar produto',
			'produto' => $produtoEncontrado,
			'categorias' => $categoriasEncontradas,
			'marcas' => $marcasEncontradas,
		];

		$this->view($dados, 'admin_form_editar_produto');

	}

	public function update($args) {
		$id = filter_var($args[0], FILTER_SANITIZE_NUMBER_INT);

		$rules = ['produto_nome' => 'required', 'produto_slug' => 'required', 'produto_valor' => 'required',
			'produto_categoria' => 'required', 'produto_marca' => 'required',
			'produto_garantia' => 'required', 'produto_descricao' => 'required'];

		$validate = new Validate($rules);
		$validate->validate()->repeatedRegisters(new RepeatRegistersAdmin);

		if (!ErrorsValidate::erroValidacao()) {
			$filter = new MassFilter;
			$filter->filterInputs(
				'produto_nome', 'produto_slug', 'produto_valor', 'produto_categoria', 'produto_marca',
				'produto_garantia', 'produto_descricao'
			);

			$produtoModel = new ProdutoModel;
			$atualizado = $produtoModel->update($filter->all(), $id);

			if ($atualizado) {
				FlashMessage::add(
					'mensagem_produto', 'Atualizado com sucesso !!!', 'success'
				);
				return Redirect::back();
			}

			FlashMessage::add(
				'mensagem_produto', 'Erro ao atualizar, tente novamente'
			);
			return Redirect::back();
		}

		Redirect::back();

	}

	public function destroy($args) {
		$id = filter_var($args[0], FILTER_SANITIZE_NUMBER_INT);

		$produtoModel = new ProdutoModel;
		$produtoEncontrado = $produtoModel->find('id', $id);

		@unlink($produtoEncontrado->produto_foto);

		$produtosModel->delete('id', $id);

		Redirect::back();

	}

}