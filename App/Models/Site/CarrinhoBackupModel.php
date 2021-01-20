<?php

namespace App\Models\Site;

use App\Models\Model;

class CarrinhoBackupModel extends Model{
	
	public $table = 'carrinho_backup';

	public function add($produto, $quantidade, $sessao){
		$sql = "insert into {$this->table}(produto,quantidade,sessao) values(?,?,?)";
		$this->typeDatabase->prepare($sql);
		$this->typeDatabase->bindValue(1,$produto);
		$this->typeDatabase->bindValue(2,$quantidade);
		$this->typeDatabase->bindValue(3,$sessao);
		return $this->typeDatabase->execute();
	}

	public function remove($id,$sessao){
		$sql = "delete from {$this->table} where produto = ? and sessao = ?";
        $this->typeDatabase->prepare($sql);
        $this->typeDatabase->bindValue(1, $id);
        $this->typeDatabase->bindValue(2, $sessao);
        return $this->typeDatabase->execute();
	}
}