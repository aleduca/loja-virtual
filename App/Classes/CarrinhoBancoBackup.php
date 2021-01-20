<?php

namespace App\Classes;

use App\Models\Site\CarrinhoBackupModel;
use App\Models\Site\CarrinhoModel;

class CarrinhoBancoBackup {

    private $carrinhoBackupModel;
    
    public function __construct() {
        $this->carrinhoBackupModel = new CarrinhoBackupModel();
    }

    public function add($sessao){
        $carrinhoModel = new CarrinhoModel;
        $produtosCarrinho = $carrinhoModel->find('sessao',$sessao,'all');
        foreach($produtosCarrinho as $produto){
            $this->carrinhoBackupModel->add($produto->produto,$produto->quantidade,$produto->sessao);
        }
    }

    public function remove($sessao){
        $produtosCarrinho = $this->carrinhoBackupModel->find('sessao', $sessao, 'all');
        foreach ($produtosCarrinho as $produto) {
            $this->carrinhoBackupModel->remove($produto->produto, $produto->sessao);
        }
    }
}
