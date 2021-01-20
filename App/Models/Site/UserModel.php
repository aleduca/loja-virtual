<?php

namespace App\Models\Site;

use App\Models\Model;

class UserModel extends Model {

    public $table = "users";

    public function create(Array $attributes) {
        $sql = "insert into {$this->table}(name,sobrenome,is_admin,email,password,ddd,telefone, endereco, bairro, cidade,cep, estado) values(?,?,?,?,?,?,?,?,?,?,?,?)";
        $this->typeDatabase->prepare($sql);
        $i = 1;
        foreach ($attributes as $attribute) {
            $this->typeDatabase->bindValue($i, $attribute);
            $i++;
        }
        return $this->typeDatabase->execute();
    }

    public function updatePassword($password, $email){
        $sql = "update {$this->table} set password = ? where email = ?";
        $this->typeDatabase->prepare($sql);
        $this->typeDatabase->bindValue(1,$password);
        $this->typeDatabase->bindValue(2,$email);
        return $this->typeDatabase->execute();
    }

}
