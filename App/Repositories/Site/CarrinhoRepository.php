<?php

namespace App\Repositories\Site;

use App\Models\Site\CarrinhoModel;

class CarrinhoRepository {

    private $carrinho;

    public function __construct() {
        $this->carrinho = new CarrinhoModel;
    }

    public function produtoSessao($produto, $sessao) {
        $sql = "select * from {$this->carrinho->table} where produto = ? and sessao = ?";
        $this->carrinho->typeDatabase->prepare($sql);
        $this->carrinho->typeDatabase->bindValue(1, $produto);
        $this->carrinho->typeDatabase->bindValue(2, $sessao);
        $this->carrinho->typeDatabase->execute();
        return $this->carrinho->typeDatabase->fetch();
    }

    public function updateStatus($sessao){
        $sql = "update {$this->carrinho->table} set status = ? where sessao = ?";
        $this->carrinho->typeDatabase->prepare($sql);
        $this->carrinho->typeDatabase->bindValue(1, 1);
        $this->carrinho->typeDatabase->bindValue(2, $sessao);
        $this->carrinho->typeDatabase->execute();
        return $this->carrinho->typeDatabase->rowCount();
    }


}
