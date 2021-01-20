<?php

namespace App\Controllers\admin;

use App\Classes\ErrorsValidate;
use App\Classes\PersistInput;
use App\Classes\RepeatRegistersAdmin;
use App\Classes\Validate;
use App\Controllers\BaseController;
use App\Models\Admin\UserModel;
use App\Repositories\Admin\ClientesRepository;

class AdminClientesController extends BaseController {

	public function index() {

		$users = new ClientesRepository;

		if (isset($_GET['s'])) {
			$usersEncontrados = $users->select('*')->busca(['name'])->paginate(15)->get();
		} else {
			$usersEncontrados = $users->select('*')->paginate(2)->get();
		}

		$this->view([
			'titulo' => 'Lista de Clientes',
			'users' => $usersEncontrados,
			'links' => $users->links(),
		], 'admin_listar_clientes');
	}

	public function create() {
		$this->view(['titulo' => 'Cadastro de Clientes'], 'admin_form_cadastrar_clientes');
	}

	public function store() {
		if ($this->get('request')->request('post')) {

			$rules = [
				'name' => 'required',
				'sobrenome' => 'required:user',
				'email' => 'required',
				'bairro' => 'required',
				'estado' => 'required',
				'cep' => 'required',
				'cidade' => 'required',
				'endereco' => 'required',
				'ddd' => 'required',
				'telefone' => 'required',
				'password' => 'required',
			];

			$validate = new Validate($rules);
			$validate->validate()->repeatedRegisters(new RepeatRegistersAdmin);

			if (!ErrorsValidate::erroValidacao()) {
				$filter = $this->get('filters');
				$filter->filterInputs('name', 'sobrenome', 'is_admin:int=2',
					'email:email', 'password', 'ddd:int', 'telefone:int',
					'endereco', 'bairro', 'cidade', 'cep',
					'estado');

				if ((new UserModel)->create($filter->all('password'))) {
					$this->get('flash')->add('mensagem_cliente', 'Cadastrado com sucesso !!!', 'success');
					return $this->get('redirect')->redirect('/adminClientes/create');
				}

				$this->get('flash')->add('mensagem_cliente', 'Erro ao cadastrar, tente novamente');
				return $this->get('redirect')->redirect('/adminClientes/create');

			}
			return $this->get('redirect')->back();
		}
	}

	public function edit($id) {
		$id = filter_var($id[0], FILTER_SANITIZE_NUMBER_INT);

		$user = new UserModel;
		$userEncontrado = $user->find('id', $id);

		$this->view([
			'titulo' => 'Lista de Clientes',
			'user' => $userEncontrado,
		], 'admin_form_editar_cliente');

	}

	public function update($id) {

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$rules = ['name' => 'required', 'sobrenome' => 'required:user', 'email' => 'required', 'bairro' => 'required', 'estado' => 'required', 'cep' => 'required', 'cidade' => 'required', 'endereco' => 'required', 'ddd' => 'required', 'telefone' => 'required'];

			$validate = new Validate($rules);
			$validate->validate();

			if (!ErrorsValidate::erroValidacao()) {
				$filter = new MassFilter;
				$filter->filterInputs('name', 'sobrenome', 'email:email', 'ddd:int', 'telefone:int', 'endereco', 'bairro', 'cidade', 'cep', 'estado');

				$atualizado = (new UserModel)->update($filter->all(), $id);

				if ($atualizado) {

					FlashMessage::add('mensagem_cliente', 'Atualizado com sucesso !!!', 'success');
					PersistInput::removeInputs();

					return Redirect::redirect('/adminClientes');
				}
				FlashMessage::add('mensagem_cliente', 'Erro ao atualizar, tente novamente');
				return Redirect::redirect('/adminClientes');

			}

		}
	}

	public function destroy($id) {

		$user = new UserModel;
		$user->delete('id', $id[0]);

		Redirect::redirect('/adminClientes');
	}

}