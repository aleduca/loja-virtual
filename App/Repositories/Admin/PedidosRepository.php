<?php

namespace App\Repositories\Admin;

use App\Models\Admin\PedidosModel;

class PedidosRepository extends \App\Repositories\Repository{
	
	protected $model;
	
	public function __construct() {
		$this->model = new PedidosModel;
	}
	
	public function totalVendas() {
	    $this->sql = "select sum(total) as totalPedidos from {$this->model->table} where pedido_status = 1";
		
		return $this;
	}
	
	public function totalVendasMes(){
	    $this->sql = "select sum(total) as totalPedidos from {$this->model->table} where MONTH(CREATED_AT) = MONTH(CURDATE()) and YEAR(created_at) = YEAR(CURDATE()) and pedido_status = 1";
		
		return $this;
	}
	
	// 	para o grafico
	public function vendasMeses(){
	    $this->sql = "select * from {$this->model->table} where YEAR(created_at) = YEAR(CURDATE()) and pedido_status = 1 order by created_at ASC";
		return $this;
		
	}
	
	public function listaVendas() {
	    $this->sql = "select pedidos.id as idPedido, pedido_frete,total,name,sobrenome,pedidos.created_at as createdAt from {$this->model->table} inner join users on users.id = pedido_user where pedido_status = 1";
		
		return $this;
		
	}
	
	public function listaVendasMes() {
	    $this->sql = "select pedidos.id as idPedido, pedido_frete,total,name,sobrenome,pedidos.created_at as createdAt from {$this->model->table} inner join users on users.id = pedido_user where MONTH(CREATED_AT) = MONTH(CURDATE()) and YEAR(created_at) = YEAR(CURDATE()) and pedido_status = 1";
		
		return $this;
	}
	
}
