<?php

namespace App\Controllers\Admin;

use App\Classes\FormatMonth;
use App\Controllers\BaseController;
use App\Repositories\Admin\PedidosRepository;

class ChartController extends BaseController{
    
    public function mes(){
       
        $vendasMes = (new PedidosRepository)->vendasMeses()->get();
        
        $return['meses'] = [];

        foreach ($vendasMes as $value) {
            $formatMonth = FormatMonth::format(date('m', strtotime($value->created_at)));
            
            if(array_key_exists($formatMonth, $return['meses'])){
                $return['meses'][$formatMonth]+=$value->total;
            }else{
                $return['meses'][$formatMonth]=$value->total; 
            }
        }

        $meses = array_keys($return['meses']);

        $valores = array_values($return['meses']);

        echo json_encode(['meses' => $meses,'valores' => $valores,'max' => max(array_values($return['meses']))]);
    }

}