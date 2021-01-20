<?php

namespace App\Controllers\Site;

use App\Classes\Authenticated;
use App\Classes\Logado;
use App\Classes\Redirect;
use App\Controllers\BaseController;
use App\Repositories\Site\PedidosRepository;

class ComprasController extends BaseController{

	public function index(){

		if(!Logado::logado()) return Redirect::redirect('/');

		$pedidos = new PedidosRepository;
		$dadosPedidos = $pedidos->pedidos(Authenticated::user()->id);

		$dados = [
		    'titulo' => 'Curso PHPOO AWB | Compras',
		    'pedidos' => $dadosPedidos
		];

		$template = $this->twig->loadTemplate('site_minhas_compras.html');
		$template->display($dados);
		
	}
	
}