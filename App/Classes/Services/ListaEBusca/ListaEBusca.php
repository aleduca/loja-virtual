<?php

namespace App\Classes\Services\listaEBusca;
use App\Repositories\Admin\PedidosProdutosRepository;
use App\Interfaces\InterfaceListaEBusca;

class ListaEBusca{
	
	public function listaEBusca(InterfaceListaEBusca $listaEBusca){
		return $listaEBusca->listar();
    }
	
}
