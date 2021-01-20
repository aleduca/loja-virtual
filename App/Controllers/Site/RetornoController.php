<?php

namespace App\Controllers\Site;

use App\Classes\PagseguroPayment;
use App\Classes\Payment;
use App\Controllers\BaseController;

class RetornoController extends BaseController{
	
	public function pagseguro(){
		if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['notificationType']) == 'transaction'){

			$emailPagseguro = 'seu_email';
			$tokenPagseguro = 'seu_token';
			$notificationCode = $_POST['notificationCode'];

			// Mudar para sandbox se for trabalhar localmente
			$url = "https://ws.pagseguro.uol.com.br/v2/transactions/notifications/{$notificationCode}?email={$emailPagseguro}&token={$tokenPagseguro}";

		    $curl = curl_init($url);
		    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		    $transaction_curl = curl_exec($curl);
		    curl_close($curl);

		    $transaction = simplexml_load_string($transaction_curl);

		    $statusPagamento = new Payment(new PagseguroPayment());
		    $statusPagamento->paymentStatus($transaction);

		}
	}

	public function paypal(){
		// codigo para receber do paypal
	}

}