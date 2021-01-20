<?php

namespace App\Traits;

// Usado no checkoutValidate
trait ErrorsCheckoutValidate {
	public function error($error){
		echo json_encode($error);
		die();
	}
}