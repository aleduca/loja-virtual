<?php

namespace App\Classes;

use Cagartner\CorreiosConsulta\CorreiosConsulta;

class Correios {

    private $tipo;
    private $formato;
    private $cepDestino;
    private $cepOrigem;
    private $peso;
    private $comprimento;
    private $altura;
    private $largura;
    private $diametro;
    private $correios;

    public function __construct() {
        $this->correios = new CorreiosConsulta();
    }

    function setFormato($formato) {
        $this->formato = $formato;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setCepDestino($cepDestino) {
        $this->cepDestino = $cepDestino;
    }

    function setCepOrigem($cepOrigem) {
        $this->cepOrigem = $cepOrigem;
    }

    function setPeso($peso) {
        $this->peso = $peso;
    }

    function setComprimento($comprimento) {
        $this->comprimento = $comprimento;
    }

    function setAltura($altura) {
        $this->altura = $altura;
    }

    function setLargura($largura) {
        $this->largura = $largura;
    }

    function setDiametro($diametro) {
        $this->diametro = $diametro;
    }

    private function dadosCalcularFrete() {
        $dados = [
            'tipo' => $this->tipo, // opções: `sedex`, `sedex_a_cobrar`, `sedex_10`, `sedex_hoje`, `pac`, 'pac_contrato', 'sedex_contrato' , 'esedex'
            'formato' => $this->formato, // opções: `caixa`, `rolo`, `envelope`
            'cep_destino' => $this->cepDestino, // Obrigatório
            'cep_origem' => $this->cepOrigem, // Obrigatorio
            //'empresa'         => '', // Código da empresa junto aos correios, não obrigatório.
            //'senha'           => '', // Senha da empresa junto aos correios, não obrigatório.
            'peso' => $this->peso, // Peso em kilos
            'comprimento' => $this->comprimento, // Em centímetros
            'altura' => $this->altura, // Em centímetros
            'largura' => $this->largura, // Em centímetros
            'diametro' => $this->diametro, // Em centímetros, no caso de rolo
                // 'mao_propria'       => '1', // Não obrigatórios
                // 'valor_declarado'   => '1', // Não obrigatórios
                // 'aviso_recebimento' => '1', // Não obrigatórios
        ];

        return $dados;
    }

    public function calcularFrete() {
        return $this->correios->frete($this->dadosCalcularFrete());
    }

}
