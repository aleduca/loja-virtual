<?php

namespace App\Classes;

use App\Classes\CarrinhoBanco;
use App\Classes\CarrinhoBancoBackup;
use App\Classes\Pedidos;
use App\Classes\RetornaEstoque;
use App\Classes\SendEmailPayment;
use App\Interfaces\InterfaceStatusTransaction;

class PypalStatusTransactions implements InterfaceStatusTransaction {

    private $email;
    private $data;
    private $pedidos;
    private $carrinhoBackup;
    private $retornaEstoque;

    public function __construct($dataServiceProvider, 
            SendEmailPayment $email, 
            Pedidos $pedidos, 
            CarrinhoBanco $carrinhoBanco, 
            CarrinhoBancoBackup $carrinhoBackup, 
            RetornaEstoque $retornaEstoque) 
            {
        $this->data = $dataServiceProvider;
        $this->email = $email;
        $this->pedidos = $pedidos;
        $this->carrinhoBanco = $carrinhoBanco;
        $this->carrinhoBackup = $carrinhoBackup;
        $this->retornaEstoque = $retornaEstoque;
    }

    public function aguardePagamento($transaction) {
        // passando todos os dados do retorno para a classe que envia o email, asism uso o que precisar
        $this->email->aguardePagamento($transaction);
    }

    public function pagamentoAnalise($transaction) {
        $this->email->pagamentoAnalise($transaction)
    }

    public function vendaAprovada() {
        $this->email->vendaAprovada($transaction);
    
        $this->carrinhoBanco->remove($this->dataPagseguro->reference);
        $this->pedidos->update($this->dataPagseguro->reference, 1);
    }

    public function pagamentoDisponivel() {
        $this->email->pagamentoDisponivel($transaction);
 
        $this->carrinhoBackup->add($this->dataPagseguro->refrence);
        $this->carrinhoBanco->remove($this->dataPagseguro->reference);
    }

    public function emDisputa() {
        $this->email->emDisputa($transaction);
    
    }

    public function valorDevolvido() {
        $this->email->valorDevolvido($transaction);
      
        $this->retornaEstoque->retornaEstoqueBackup($this->dataPagseguro->reference);
        $this->carrinhoBanco->remove($this->dataPagseguro->reference);
        $this->pedidos->remove($this->data->reference);
    }

    public function compraCancelada() {
        $this->email->compraCancelada($transaction);
 
       $this->retornaEstoque->retornaEstoqueBackup($this->dataPagseguro->reference);
       $this->$excuirCarrinhoBanco->remove($this->data->reference);
       $this->pedidos->remove($this->data->reference);
    }

}
