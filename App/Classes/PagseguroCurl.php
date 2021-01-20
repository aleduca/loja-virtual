<?php

namespace App\Classes;

class PagseguroCurl{
    
    public function get($url,$query){
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, Array('Content-Type: application/x-www-form-urlencoded; charset=UTF-8'));
            curl_setopt($curl, CURLOPT_POST,1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $query);
            $retorno_transaction = curl_exec($curl);
            curl_close($curl);
            return simplexml_load_string($retorno_transaction);
    }

}