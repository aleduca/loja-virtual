<?php

namespace App\Repositories\Site;

use App\Models\Site\PedidosModel;

class PedidosRepository{

	private $pedidos;

	public function __construct(){
	    $this->pedidos = new PedidosModel;
	}

	public function pedidos($user){
		$sql = "select * from pedidos where pedidos.pedido_user = ?";
		$this->pedidos->typeDatabase->prepare($sql);
		$this->pedidos->typeDatabase->bindValue(1, $user);
		$this->pedidos->typeDatabase->execute();
		return $this->pedidos->typeDatabase->fetchAll();
	}

}