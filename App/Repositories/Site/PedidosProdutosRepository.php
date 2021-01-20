<?php

namespace App\Repositories\Site;

use App\Models\Site\PedidosProdutosModel;
use App\Models\Site\ProdutoModel;

class PedidosProdutosRepository{

	private $pedidos;

	public function __construct(){
	    $this->pedidos = new PedidosProdutosModel;
	}

	public function pedidos($user, $sessao){
		$sql = "select produto, quantidade, valor, subtotal from pedidos_produtos where pedidos_produtos.user = ? and pedidos_produtos.sessao = ?";
		$this->pedidos->typeDatabase->prepare($sql);
		$this->pedidos->typeDatabase->bindValue(1, $user);
		$this->pedidos->typeDatabase->bindValue(2, $sessao);
		$this->pedidos->typeDatabase->execute();
		return $this->pedidos->typeDatabase->fetchAll();
	}

	public function produtosPedido($pedidos){
		$produtos = [];

		$produtoModel = new ProdutoModel;

		foreach ($pedidos as $pedido) {
		    $produtosPedido = $produtoModel->find('id', $pedido->produto);
		    $produtos[] = [
		        'produtos' => $produtosPedido,
		        'subtotal' => $pedido->subtotal,
		        'qtd' => $pedido->quantidade,
		        'valor' => $pedido->valor
		    ];
		}
		return $produtos;
	}

}