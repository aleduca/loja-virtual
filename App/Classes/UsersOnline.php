<?php

namespace App\Classes;

use App\Models\Site\UserOnlineModel;

class UsersOnline{

	private $userOnlineModel;
	private $ip;

	public function __construct(){
		$this->userOnlineModel = new UserOnlineModel;
		$this->ip = $_SERVER['REMOTE_ADDR'];
	}

	private function userAlreadyOnline(){
		$user = $this->userOnlineModel->find('ip',$this->ip);
		return ($user) ? true : false;
	}

	private function addUser(){
		if(!$this->userAlreadyOnline()){
			// adicionar
			return $this->userOnlineModel->create([
				$this->ip, 
				IdRandom(),
				date('Y-m-d H:i:s', strtotime('+5minutes'))
				]);
		}
		// atualizar
		return $this->userOnlineModel->update(date('Y-m-d H:i:s', strtotime('+5minutew')), IdRandom());
	}

	public function run(){
		// pode criar uma cronjob para deletar os usuarios que ja nao estao online, porque do jeito que esta nunca vai ter 0
		// usuarios online
		// Ou posso colocar um if aqui embaixo no remove, assim ele deleta e nao cadastra um novo registro, assim fica 0, mas quando atualizar a pagina de novo, vai cadastrar.
		if($this->userOnlineModel->remove()){
			return;
		}
		$this->addUser();
	}
	
}