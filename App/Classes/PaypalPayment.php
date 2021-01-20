<?php

namespace App\Classes;

use App\Interfaces\InterfaceGerenciaStatusTransaction;
use App\Interfaces\InterfaceStatusTransaction;

class PaypalPayment implements InterfaceGerenciaStatusTransaction {

    private $statusTransactions;

    public function __construct(InterfaceStatusTransaction $statusTransactions) {
        $this->statusTransactions = $statusTransactions;
    }

    public function paymentStatus($transaction) {
        switch ($transaction->status) {
            case '1':
                $this->statusTransactions->aguardePagamento($transaction);
                break;
            case '2':
                $this->statusTransactions->pagamentoAnalise($transaction);
                break;
            case '3':
                $this->statusTransactions->vendaAprovada($transaction);
                break;
            case '4':
                $this->statusTransactions->pagamentoDisponivel($transaction);
                break;
            case '5':
                $this->statusTransactions->emDisputa($transaction);
                break;
            case '6':
                $this->statusTransactions->valorDevolvido($transaction);
                break;
            case '7':
                $this->statusTransactions->compraCancelada($transaction);
                break;
        }
    }
}