<?php

namespace App\Classes;

use App\Classes\Carrinho;
use App\Classes\StatusCarrinho;
use App\Models\Site\CarrinhoModel;
use App\Repositories\Site\CarrinhoRepository;

class CarrinhoBanco {

    private $carrinhoModel;

    public function __construct() {
        $this->carrinhoModel = new CarrinhoModel;
    }

    public function add($id) {
         $this->carrinhoModel->add([
             1 => $id,
             2 => 1,
             3 => idRandom(),
             4 => date('Y-m-d H:i:s'),
             5 => date('Y-m-d H:i:s', strtotime('10minutes')),
             6 => 2
         ]);
    }

    public function update($id) {
        $this->carrinhoModel->update($id, Carrinho::produtoCarrinho($id), idRandom());
    }

    // precisa desse metodo para atualizar status do carrinho no banco, posso mostrar esse metodo mais para frente no curso(Checkout)
    public function updateStatus($sessao) {
        $carrinhoRepository = new CarrinhoRepository;
        return $carrinhoRepository->updateStatus($sessao);
    }

    // Remove todos produtos
    public function remove($sessao) {
        $produtosCarrinho = $this->carrinhoModel->find('sessao', $sessao, 'all');
        foreach ($produtosCarrinho as $produto) {
            $this->carrinhoModel->remove($produto->produto, $produto->sessao);
        }
    }

    // Remove um produto de cada vez
    public function removeProduct($produto, $sessao) {
        $this->carrinhoModel->remove($produto, $sessao);
    }

}
