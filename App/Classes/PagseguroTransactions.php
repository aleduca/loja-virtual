<?php

namespace App\Classes;

use App\Classes\CarrinhoBanco;
use App\Classes\CarrinhoBancoBackup;
use App\Classes\ErrorRetorno;
use App\Classes\Pedidos;
use App\Classes\RetornaEstoque;
use App\Classes\RetornaEstoqueBackup;
use App\Classes\SuccessRetorno;
use App\Interfaces\InterfaceEmailPayment;
use App\Interfaces\InterfaceStatusTransaction;

class PagseguroTransactions {

    private $email;
    private $dataPagseguro;
    private $pedidos;
    private $carrinhoBackup;
    private $retornaEstoque;
    private $retornaEstoqueBackup;

    public function __construct($dataServiceProvider, InterfaceEmailPayment $email) 
    {
        $this->data = $dataServiceProvider;
        $this->email = $email;
    }

    public function aguardePagamento($transaction) {
        $this->email->aguardePagamento($transaction);
    }

    public function pagamentoAnalise($transaction) {
        $this->email->pagamentoAnalise($transaction);
    }

    public function vendaAprovada($transaction) {
        // $this->email->vendaAprovada($transaction);
        SuccessRetorno::run($transaction);
    }

    public function pagamentoDisponivel($transaction) {
        $this->email->pagamentoDisponivel($transaction);
    }

    public function emDisputa($transaction) {
        $this->email->emDisputa($transaction);
    }

    public function valorDevolvido($transaction) {
        $this->email->valorDevolvido($transaction);
        ErrorRetorno::run($transaction);
    }

    public function compraCancelada($transaction) {
        $this->email->compraCancelada($transaction);
        ErrorRetorno::run($transaction);
    }

}
