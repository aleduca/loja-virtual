<?php

namespace App\Classes;

class AddFunctionsTwig{
	
	public function run($twig, $functionsTwig){
		foreach($functionsTwig->functions as $function){
			$twig->addFunction($function);
		}
	}

}