<?php

namespace App\Classes;

use App\Models\Site\CarrinhoBackupModel;
use App\Classes\Estoque;

class RetornaEstoqueBackup{

    private $estoque;
    private $carrinhoBackupModel;

    public function __construct() {
        $this->estoque = new Estoque;
    }

    public function retornaEstoqueBackup($sessao){
        $carrinhoBackupModel = new CarrinhoBackupModel;
        $produtosCarrinho = $carrinhoBackupModel->find('sessao',$sessao,'all');
         foreach($produtosCarrinho as $produto){
            $this->estoque->atualizaEstoque($produto->produto, 
                ($this->estoque->estoqueAtual($produto->produto) + $produto->quantidade));
        }
    }
}