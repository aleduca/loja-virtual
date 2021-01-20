<?php

namespace App\Repositories\Site;

use App\Models\Site\AvaliacoesModel;

class AvaliacoesRepository {

	private $avaliacoes;

	public function __construct() {
		$this->avaliacoes = new AvaliacoesModel;
	}

	public function listarAvaliacoesComLimite($produto, $limite) {
		$sql = "select *,avaliacoes.id as avaliacaoId,avaliacoes.created_at as avaliacaoCreated from {$this->avaliacoes->table} inner join users on(avaliacoes.cliente = users.id) where produto = ? limit $limite";
		$this->avaliacoes->typeDatabase->prepare($sql);
		$this->avaliacoes->typeDatabase->bindValue(1, $produto);
		$this->avaliacoes->typeDatabase->execute();
		return $this->avaliacoes->typeDatabase->fetchAll();
	}

	public function listarTodasAvaliacoes($produto) {
		$sql = "select *,avaliacoes.id as avaliacaoId,avaliacoes.created_at as avaliacaoCreated from {$this->avaliacoes->table} inner join users on(avaliacoes.cliente = users.id) where produto = ?";
		$this->avaliacoes->typeDatabase->prepare($sql);
		$this->avaliacoes->typeDatabase->bindValue(1, $produto);
		$this->avaliacoes->typeDatabase->execute();
		return $this->avaliacoes->typeDatabase->fetchAll();
	}

	public function totalAvaliacoesProduto($produto) {
		$sql = "select count(*) as totalAvaliacoes from {$this->avaliacoes->table} inner join users on(avaliacoes.cliente = users.id) where produto = ?";
		$this->avaliacoes->typeDatabase->prepare($sql);
		$this->avaliacoes->typeDatabase->bindValue(1, $produto);
		$this->avaliacoes->typeDatabase->execute();
		return $this->avaliacoes->typeDatabase->fetch();
	}

	public function verificaSeClienteAvaliouProduto($produto, $cliente) {
		$sql = "select * from {$this->avaliacoes->table} where produto = ? and cliente = ?";
		$this->avaliacoes->typeDatabase->prepare($sql);
		$this->avaliacoes->typeDatabase->bindValue(1, $produto);
		$this->avaliacoes->typeDatabase->bindValue(2, $cliente);
		$this->avaliacoes->typeDatabase->execute();
		return $this->avaliacoes->typeDatabase->fetch();
	}

	public function media($produto) {
		$sql = "select avg(estrelas) as media from {$this->avaliacoes->table} where produto = ?";
		$this->avaliacoes->typeDatabase->prepare($sql);
		$this->avaliacoes->typeDatabase->bindValue(1, $produto);
		$this->avaliacoes->typeDatabase->execute();
		return $this->avaliacoes->typeDatabase->fetch();
	}

}
