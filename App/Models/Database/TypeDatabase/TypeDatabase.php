<?php

namespace App\Models\Database\TypeDatabase;

use App\Interfaces\InterfaceTypeDatabase;

class TypeDatabase{

    private $interfaceTypeDatabase;

    public function __construct(InterfaceTypeDatabase $interfaceTypeDatabase){
        $this->interfaceTypeDatabase = $interfaceTypeDatabase;
    }

    public function getDatabase(){
        return $this->interfaceTypeDatabase;
    }

}