<?php

 namespace App\Controllers\Site;

 use App\Controllers\BaseController;

 class ProdutoController extends BaseController{

    public function index($parameters){
        dump($parameters[2]);
    }

    public function calca($parameters){
        dump($parameters[2]);
    }

 }