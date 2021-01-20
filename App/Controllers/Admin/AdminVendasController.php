<?php

namespace App\Controllers\Admin;

use App\Classes\Forms\VendaUpdate;
use App\Controllers\BaseController;
use App\Models\Admin\PedidosProdutosModel;
use App\Models\Admin\ProdutoModel;
use App\Classes\Services\ListaEBusca\ListaEBusca;
use App\Classes\Services\ListaEBusca\Vendas;

class AdminVendasController extends BaseController {
	
	public function index() {
		
		$vendas = new Vendas;
		$pedidosEncontrados = $this->load(ListaEBusca::class)->listaEBusca($vendas);
		
		$this->view([
			'titulo' => 'Listando vendas',
			'pedidos' => $pedidosEncontrados,
			'links' => $vendas->links(),
		], 'admin_listar_vendas');
	}
	
	public function edit($id) {
		$id = filter_var($id[0], FILTER_SANITIZE_NUMBER_INT);
		
		$pedidos = $this->load(PedidosProdutosModel::class);
		$pedidoEncontrado = $pedidos->find('id', $id);
		
		$produtos = $this->load(ProdutoModel::class);
		$produtoEncontrado = $produtos->findWithFields('id', $pedidoEncontrado->produto, 'produto_nome');
		
		$this->view([
			'titulo' => 'Editar Venda',
			'pedido' => $pedidoEncontrado,
			'produto' => $produtoEncontrado,
		], 'admin_form_editar_venda');
		
	}
	
	public function update($id) {
		$id = filter_var($id[0], FILTER_SANITIZE_NUMBER_INT);
		
		$vendaForm = new VendaUpdate();
		$vendaForm->update($id);
		
	}
	
	public function destroy($id) {
		$id = filter_var($id[0], FILTER_SANITIZE_NUMBER_INT);
		
		$pedido = $this->load(PedidosProdutosModel::class);
		$pedido->delete('id', $id);
		
		$this->get('redirect')->back();
	}
	
}
