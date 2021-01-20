<?php

namespace App\Classes;

use App\Interfaces\InterfaceStatusPayment;

class Payment {

	private $payment;

	public function __construct(InterfaceStatusPayment $payment){
		$this->payment = $payment;
	}

	public function paymentStatus($transaction){
		return $this->payment->paymentStatus($transaction);
	}

}