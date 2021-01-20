<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\UserModel;
use App\Models\Admin\UserOnlineModel;
use App\Repositories\Admin\PedidosProdutosRepository;
use App\Repositories\Admin\PedidosRepository;
use App\Repositories\Admin\UsersRepository;

class PainelController extends BaseController {

	public function index() {

		$pedidos = new PedidosRepository;
		$totalVendas = $pedidos->totalVendas()->first();
		$totalVendasMes = $pedidos->totalvendasMes()->first();

		$users = new UserModel;
		$totalUsers = $users->fetchAll();

		$usersOnline = new UserOnlineModel;
		$totalUsersOnline = $usersOnline->fetchAll();

		$pedidosProdutos = new PedidosProdutosRepository;
		$pedidosEncontrados = $pedidosProdutos->listaVendas()->limit(2)->get();

		$usersRepository = new UsersRepository;
		$listaUsers = $usersRepository->listaUsers()->limit(6)->get();

		$dados = [
			'titulo' => 'Curso PHPOO AWB | Login Admin',
			'totalVendas' => $totalVendas,
			'totalVendasMes' => $totalVendasMes,
			'totalUsers' => count($totalUsers),
			'totalUsersOnline' => count($totalUsersOnline),
			'listaVendas' => $pedidosEncontrados,
			'ultimosClientes' => $listaUsers,
		];

		$this->view($dados, 'admin_home');
	}

}