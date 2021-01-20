<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Repositories\Site\ProdutosCarrinhoRepository;
use App\Classes\Correios;
use App\Classes\Frete;
use App\Classes\Logado;

class FreteController extends BaseController {

    private $produtoCarrinhoRepository;
    private $correios;

    public function __construct() {
        $this->produtoCarrinhoRepository = new ProdutosCarrinhoRepository();
        $this->correios = new Correios();
        $frete = new Frete;
    }

    public function calcular() {

        $logado = new Logado();
        if (!$logado->logado()) {
            echo json_encode('login');
            die();
        }


        if (empty($this->produtoCarrinhoRepository->produtosNoCarrinho())) {
            echo json_encode('produto');
            die();
        }

        $cep = filter_input(INPUT_POST, 'frete', FILTER_SANITIZE_STRING);
        $this->correios->setFormato('rolo');
        $this->correios->setTipo('sedex');
        $this->correios->setCepOrigem('27970570');
        $this->correios->setCepDestino(str_replace('-', '', $cep));
        $this->correios->setPeso('15');
        $this->correios->setComprimento('19');
        $this->correios->setAltura('20');
        $this->correios->setLargura('20');
        $this->correios->setDiametro('10');
        $dadosFrete = $this->correios->calcularFrete();

        if ($dadosFrete['erro']['codigo'] != 0) {
            echo json_encode([
                'erro' => 'sim',
                'mensagem' => $dadosFrete['erro']['mensagem']
            ]);
        } else {

            $frete = new Frete;
            $frete->gravarFrete($dadosFrete['valor']);

            echo json_encode([
                'erro' => 'nao',
                'frete' => $dadosFrete
            ]);
        }
    }

}
