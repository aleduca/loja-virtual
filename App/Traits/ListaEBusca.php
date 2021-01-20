<?php

namespace App\Traits;


trait ListaEBusca{
	
    protected $records;
    
    protected function isSearch(){
        return isset($_GET['s']);
    }
	
	public function links(){
		return $this->records->links();		
    }
}
	