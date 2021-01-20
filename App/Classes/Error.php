<?php

namespace App\Classes;

class Error {
	public function error404(){
		Redirect::redirect('error/error404');
	}	

	public function error503(){
		Redirect::redirect('error/error503');
	}
}