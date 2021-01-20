<?php

namespace App\Classes;

class FormatMonth{
    
    public static function format($month){
        switch ($month) {
            case '01':
                return 'Jan';
                break;
            case '02':
                return 'Fev';
                break;
            case '03':
                return 'Mar';
                break;
            case '04':
                return 'Abr';
                break;
            case '05':
                return 'Mai';
                break;
           case '06':
               return 'Jun';
               break;
           case '07':
               return 'Jul';
               break;         
            case '08':
                return 'Ago';
                break;
            case '09':
                return 'Set';
                break;
            case '10':
                return 'Out';
                break;
            case '11':
                return 'Nov';
                break;
             case '12':
                 return 'DEZ';
                 break;                  
        }
    }

}