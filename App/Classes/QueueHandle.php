<?php

namespace App\Classes;

// Tomar cuidado em usar o QueheHandle por ele ser herdado nas classes que for usar
// e com isso nao vai seguir o padrao da herança (é um)
abstract class QueueHandle{

	public static function queueOperations(){
		return (new Static())->handle();
	}

	abstract public function handle();	
}