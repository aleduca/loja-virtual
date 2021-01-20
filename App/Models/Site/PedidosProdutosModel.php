<?php

namespace App\Models\Site;

use App\Models\Model;

class PedidosProdutosModel extends Model{
	public $table = 'pedidos_produtos';

	public function create($attributes){
		$sql = "insert into {$this->table}(produto, valor, quantidade, sessao, user, subtotal) values(?,?,?,?,?,?)";
		$this->typeDatabase->prepare($sql);
		$i=1;
		foreach($attributes as $attribute){
			$this->typeDatabase->bindValue($i, $attribute);
			$i++;
		}
		return $this->typeDatabase->execute();
	}

}