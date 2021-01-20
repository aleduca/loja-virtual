<?php

namespace App\Classes;

use App\Classes\PagseguroStatusTransactions;
use App\Classes\SendEmailPagseguroPayment;
use App\Interfaces\interfaceStatusPayment;

class PagseguroPayment implements interfaceStatusPayment {

    public function paymentStatus($transaction) {

        $statusTransactions = new PagseguroTransactions(
            $transaction,new SendEmailPagseguroPayment($transaction)
        );

        switch ($transaction->status) {
            case '1':
                $statusTransactions->aguardePagamento($transaction);
                break;
            case '2':
                $statusTransactions->pagamentoAnalise($transaction);
                break;
            case '3':
                $statusTransactions->vendaAprovada($transaction);
                break;
            case '4':
                $statusTransactions->pagamentoDisponivel($transaction);
                break;
            case '5':
                $statusTransactions->emDisputa($transaction);
                break;
            case '6':
                $statusTransactions->valorDevolvido($transaction);
                break;
            case '7':
                $statusTransactions->compraCancelada($transaction);
                break;
        }
    }
}