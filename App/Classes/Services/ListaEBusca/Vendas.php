<?php

namespace App\Classes\Services\ListaEBusca;

use App\Interfaces\InterfaceListaEBusca;
use App\Repositories\Admin\PedidosProdutosRepository;
use App\Traits\ListaEBusca;

class Vendas implements InterfaceListaEBusca{

    use ListaEBusca;
	
	public function listar(){
        $this->records = new PedidosProdutosRepository;
        
		if ($this->isSearch()) {
			return $this->records->listaVendas()->busca(['produto_nome'])->paginate(15)->get();
		}
		return $this->records->listaVendas()->paginate(15)->orderBy(['pedidos_produtos.id', 'DESC'])->get();
		
    }
	
}
