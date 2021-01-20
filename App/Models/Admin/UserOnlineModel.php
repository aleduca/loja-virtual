<?php

namespace App\Models\Admin;

use App\Models\Model;

class UserOnlineModel extends Model{
    public $table = 'online';

    public function create($attributes){
        $sql = "insert into {$this->table}(ip, session, expire) values(?,?,?)";
        $this->typeDatabase->prepare($sql);
        $i=1;
        foreach($attributes as $attribute){
            $this->typeDatabase->bindValue($i, $attribute);
            $i++;
        }
        return $this->typeDatabase->execute();
    }

    public function update($expire, $session){
        // Posso pegar pela sessao ou pelo ip
        $sql ="update {$this->table} set expire = ? where session = ?";
        $this->typeDatabase->prepare($sql);
        $this->typeDatabase->bindValue(1,$expire);
        $this->typeDatabase->bindValue(2,$session);
        $this->typeDatabase->execute();
        return $this->typeDatabase->rowCount();
    }

    public function remove(){
        $sql = "delete from {$this->table} where NOW() > expire";
        $this->typeDatabase->prepare($sql);
        $this->typeDatabase->execute();
        return $this->typeDatabase->rowCount();
    }

}