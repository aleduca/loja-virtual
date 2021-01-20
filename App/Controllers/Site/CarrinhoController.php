<?php

namespace App\Controllers\Site;

use App\Classes\Carrinho;
use App\Classes\CarrinhoProdutoVencido;
use App\Classes\Frete;
use App\Controllers\BaseController;
use App\Repositories\Site\ProdutosCarrinhoRepository;

class CarrinhoController extends BaseController {

	private $carrinho;
	private $produtosCarrinhoRepository;

	public function __construct() {
		$this->carrinho = new Carrinho();
		$this->produtosCarrinhoRepository = new ProdutosCarrinhoRepository();
	}

	public function index() {

		$produtoVencidoCarrinho = new CarrinhoProdutoVencido();
		$produtoVencidoCarrinho->verificarProdutosVencidosCarrinho();

		$produtos = $this->produtosCarrinhoRepository->produtosNoCarrinho();

		$frete = new Frete;

		$dados = [
			'titulo' => 'Curso PHPOO | Carrinho',
			'produtos' => $produtos,
			'frete' => $frete,
		];

		$template = $this->twig->loadTemplate('site_carrinho.html');
		$template->display($dados);
	}

	public function add($param) {
		$this->carrinho->add($param[0]);
	}

	public function getCart() {
		echo json_encode([
			'numeroProdutosCarrinho' => count($this->carrinho->produtosCarrinho()),
			'valorProdutosCarrinho' => number_format($this->produtosCarrinhoRepository->totalProdutoscarrinho(), 2, ',', '.'),
		]);
	}

//    colocar nome em ingles como delete
	public function excluir() {
		$idProduto = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
		$this->carrinho->remove($idProduto);
		echo 'excluido';
	}

	public function update() {
		$idProduto = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
		$qtd = filter_var($_POST['qtd'], FILTER_SANITIZE_NUMBER_INT);

		if ($qtd <= 0) {
			$this->carrinho->remove($idProduto);
		} else {
			$this->carrinho->update($idProduto, $qtd);
		}

		echo 'atualizado';
	}

}
