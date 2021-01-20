<?php

namespace App\Classes;

class Frete {

    private function calculouFrete() {
        return (!isset($_SESSION['frete']) || $_SESSION['frete'] != true) ? false : true;
    }

    public function gravarFrete($frete) {
        $_SESSION['frete'] = true;
        $_SESSION['valor'] = $frete;
    }

    public function pegarFrete() {
        return ($this->calculouFrete()) ? $_SESSION['valor'] : 0;
    }

    public function formatFreteToObject(){
        return [
            'produtos' => (object) [
                'id' => 1,
                'produto_nome' => 'Frete'
            ],
            'qtd' => 1,
            'valor' => $this->pegarFrete()
        ];
    }

    public static function limparFrete() {
        unset($_SESSION['frete']);
        unset($_SESSION['valor']);
    }

}
