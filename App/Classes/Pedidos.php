<?php

namespace App\Classes;

use App\Classes\Authenticated;
use App\Classes\Frete;
use App\Models\Site\PedidosModel;
use App\Models\Site\PedidosProdutosModel;
use App\Repositories\Site\ProdutosCarrinhoRepository;

class Pedidos {

    private $pedidos;
    private $pedidosProdutos;
    private $produtosCarrinho;

    public function __construct(ProdutosCarrinhoRepository $produtosCarrinhoRepository) {
        $this->pedidos = new PedidosModel;
        $this->pedidosProdutos = new PedidosProdutosModel;
        $this->produtosCarrinho = $produtosCarrinhoRepository;
    }

    private function cadastroPedidos($sessao) {
        $pedidosCadastrado = false;
        foreach ($this->produtosCarrinho->produtosNoCarrinho() as $produto) {
            $attributes = [
                $produto['produtos']->id,
                $produto['valor'],
                $produto['qtd'],
                $sessao,
                Authenticated::user()->id,
                $produto['subtotal']
            ];
            if ($this->pedidosProdutos->create($attributes)) {
                $pedidosCadastrado = true;
            }
        }
        return $pedidosCadastrado;
    }

    private function cadastroPedido($sessao) {
        $pedidoCadastrado = false;
        $frete = new Frete();
        if ($this->pedidos->create([
                    Authenticated::user()->id,
                    date('Y-m-d H:i:s'),
                    $frete->pegarFrete(),
                    2,
                    $sessao,
                    $this->produtosCarrinho->totalProdutoscarrinho(),
                    1
                ])) {
            $pedidoCadastrado = true;
        }
        return $pedidoCadastrado;
    }

    public function create($sessao) {
        $cadastroPedido = $this->cadastroPedido($sessao);
        $cadastroPedidos = $this->cadastropedidos($sessao);
        return (!$cadastroPedido && !$cadastroPedidos) ? false : true;
    }

    public function remove($sessao) {
        $this->pedidos->delete('sessao', $sessao);
        $this->pedidosProdutos->delete('sessao', $sessao);
    }

    public function update($sessao,$statusPagamento,$status) {
        $this->pedidos->update($sessao,$statusPagamento,$status);
    }

}
