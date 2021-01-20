<?php

namespace App\Classes;

class Filters {

    private function hasDefault($type){
        if(substr_count($type, '=') == 1){
            return true;
        }
        return false;
    }

    private function value($value, $type){
        if($this->hasDefault($type)){
            $value = explode('=',$type);

            return $value[1];
        }

        return $_POST[$value];
    }

    private function type($type){
        if($this->hasDefault($type)){
            return strstr($type,'=',true);
        }
        return $type;
    }

    protected function filter($value, $type) {
        
        $value = $this->value($value, $type);

        switch ($this->type($type)) {
            case 'string':
                return filter_var($value, FILTER_SANITIZE_STRING);
                break;
            case 'int':
                return filter_var($value, FILTER_SANITIZE_NUMBER_INT);
                break;
            case 'email':
                return filter_var($value, FILTER_SANITIZE_EMAIL);
                break;
        }
    }

}