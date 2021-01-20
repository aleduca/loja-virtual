<?php

namespace App\Classes;

// Tomar cuidado em usar o QueheHandle por ele ser herdado nas classes que for usar
// e com isso nao vai seguir o padrao da herança (é um)
abstract class QueueRetorno{

	public static function run($transaction){
		return (new Static())->handle($transaction);
	}

	abstract public function handle($tranaction);	
}