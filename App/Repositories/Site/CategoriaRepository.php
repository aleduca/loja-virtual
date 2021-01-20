<?php

namespace App\Repositories\Site;

use App\Models\Site\CategoriaModel;

class CategoriaRepository{

    private $categoria;

    public function __construct(){
        $this->categoria = new CategoriaModel;
    }

}