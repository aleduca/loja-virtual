<?php

namespace App\Classes;

class StatusCarrinho {

    public static function carrinhoExiste() {
        return (isset($_SESSION['carrinho'])) ? true : false;
    }

    public static function criarCarrinho() {
        if (!static::carrinhoExiste()) {
            $_SESSION['carrinho'] = [];
        }
    }

    public static function produtoEstaNoCarrinho($id) {
        return isset($_SESSION['carrinho'][$id]) ? true : false;
    }

    public static function carrinho() {
        return $_SESSION['carrinho'];
    }

}