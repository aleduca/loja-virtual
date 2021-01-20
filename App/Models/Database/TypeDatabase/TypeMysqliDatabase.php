<?php

namespace App\Models\Database\TypeDatabase;

use App\Interfaces\InterfaceTypeDatabase;
use App\Models\Database\ConnectDatabase\Connection;
use App\Models\Database\ConnectDatabase\ConnectMysqliDatabase;

class TypeMysqliDatabase implements InterfaceTypeDatabase{

    private $mysqli;
    private $objectMysqli;

    public function __construct(){
        $mysqli = new Connection(new ConnectMysqliDatabase);
        $this->mysqli = $mysqli->connectDatabase();
    }

    public function prepare($sql){
        $this->objectMysqli = $this->mysqli->prepare($sql);
    }

    public function bindValue($key,$value){
        $type = substr(gettype($value),0,1);
        $this->objectMysqli->bind_param($type,$value);
    }

    public function execute(){
        $this->objectMysqli->execute();
    }

    public function rowCount(){
        return $this->objectMysqli->num_rows();
    }

    public function fetch(){
         return $this->objectMysqli->get_result()->fetch_object();
    }

    public function fetchAll(){
        $data = [];
        $result = $this->objectMysqli->get_result();
        while($resultFetch = $result->fetch_assoc()){
            $data[] = $resultFetch;
        }
        return $data;
    }


}