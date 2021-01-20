<?php 

namespace App\Classes;

use App\Interfaces\InterfacePayment;

class Paypal implements InterfacePayment{

	public function dataPayment(array $data)
	{
		throw new \Exception('Method not implemented');
	}

	public function pay()
	{
		throw new \Exception('Method not implemented');
	}
}