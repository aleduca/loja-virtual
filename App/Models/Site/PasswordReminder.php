<?php

namespace App\Models\Site;

use App\Models\Model;

class PasswordReminder extends Model{
	
	public $table = 'password_reminder';

	public function create(Array $attributes) {
	    $sql = "insert into {$this->table}(user,created_at,expire,hash)values(?,?,?,?)";
	    $this->typeDatabase->prepare($sql);
	    $i = 1;
	    foreach ($attributes as $attribute) {
	        $this->typeDatabase->bindValue($i, $attribute);
	        $i++;
	    }
	    return $this->typeDatabase->execute();
	}

}