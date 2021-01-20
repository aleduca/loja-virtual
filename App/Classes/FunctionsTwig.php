<?php

namespace App\Classes;

use App\Classes\Authenticated;
use App\Classes\BreadCrumb;
use App\Classes\Carrinho;
use App\Classes\ErrorsValidate;
use App\Classes\Estoque;
use App\Classes\FlashMessage;
use App\Classes\Frete;
use App\Classes\Logado;
use App\Classes\PersistInput;
use App\Classes\RatingStars;
use App\Classes\StatusCarrinho;
use App\Models\Site\CategoriaModel;
use App\Models\Site\MarcaModel;
use App\Repositories\Site\AvaliacoesRepository;
use App\Repositories\Site\ProdutoRepository;
use App\Repositories\Site\ProdutosCarrinhoRepository;

class FunctionsTwig {

	public $functions = [];

	private function siteUrl() {
		$this->functions['site_url'] = new \Twig_SimpleFunction('site_url', function () {
			return 'http://' . $_SERVER['SERVER_NAME'] . ':8888';
		});
		return $this;
	}

	private function listarCategorias() {
		$this->functions['categorias'] = new \Twig_SimpleFunction('categorias', function () {
			$categoriaModel = new CategoriaModel();
			return $categoriaModel->fetchAll();
		});
		return $this;
	}

	private function listarMarcas() {
		$this->functions['marcas'] = new \Twig_SimpleFunction('marcas', function () {
			$marcaModel = new MarcaModel();
			return $marcaModel->fetchAll();
		});
		return $this;
	}

	private function listarNovidades() {
		$this->functions['novidade'] = new \Twig_SimpleFunction('novidade', function () {
			$produtoRepository = new ProdutoRepository;
			return $produtoRepository->ultimoProdutoAdicionado();
		});
		return $this;
	}

	private function listarProdutosPromocao() {
		$this->functions['promocao'] = new \Twig_SimpleFunction('promocao', function () {
			$produtoRepository = new ProdutoRepository;
			return $produtoRepository->listarProdutosPromocao(1);
		});
		return $this;
	}

	private function breadCrumb() {
		$this->functions['breadCrumb'] = new \Twig_SimpleFunction('breadCrumb', function () {
			$breadCrumb = new BreadCrumb();
			return $breadCrumb->createBreadCrumb();
		});
		return $this;
	}

	private function valorProdutosCarrinho() {
		$this->functions['valorProdutosCarrinho'] = new \Twig_SimpleFunction('valorProdutosCarrinho', function () {
			$produtosCarrinhoRepository = new ProdutosCarrinhoRepository();
			return $produtosCarrinhoRepository->totalProdutoscarrinho();
		});
		return $this;
	}

	private function numeroProdutosCarrinho() {
		$this->functions['numeroProdutosCarrinho'] = new \Twig_SimpleFunction('numeroProdutosCarrinho', function () {
			return (new Carrinho)->produtosCarrinho();
		});
		return $this;
	}

	private function totalComFrete() {
		$this->functions['totalComfrete'] = new \Twig_SimpleFunction('totalComfrete', function () {

			$frete = new Frete();
			$valorFrete = $frete->pegarFrete();

			$carrinho = new ProdutosCarrinhoRepository();
			$totalCompra = $carrinho->totalProdutoscarrinho();

			return $valorFrete + $totalCompra;
		});
		return $this;
	}

	private function logado() {
		$this->functions['logado'] = new \Twig_SimpleFunction('logado', function ($permission) {
			if ($permission == 'user') {
				return Logado::logado();
			}
			return Logado::adminLogado();
		});
		return $this;
	}

	private function dadosUser() {
		$this->functions['user'] = new \Twig_SimpleFunction('user', function () {
			return Authenticated::user();
		});
		return $this;
	}

	private function errorField() {
		$this->functions['errorField'] = new \Twig_SimpleFunction('errorField', function ($field) {
			return ErrorsValidate::show($field);
		});
		return $this;
	}

	private function persistInput() {
		$this->functions['persist'] = new \Twig_SimpleFunction('persist', function ($field) {
			return PersistInput::show($field);
		});
		return $this;
	}

	private function flashMessage() {
		$this->functions['flash'] = new \Twig_SimpleFunction('flash', function ($index) {
			return FlashMessage::show($index);
		});
		return $this;
	}

	private function estoque() {
		$this->functions['estoque'] = new \Twig_SimpleFunction('estoque', function ($id) {
			$estoque = new Estoque;
			return $estoque->estoqueAtual($id);
		});
		return $this;
	}

	private function statusPagamento() {

		$this->functions['statusPagamento'] = new \Twig_SimpleFunction('statusPagamento', function ($status) {
			switch ($status) {
			case '1':
				return "Aguardando Pagamento";
				break;
			case '2':
				return "Pagamento em análise";
				break;
			case '3':
				return "Venda Aprovada";
				break;
			case '5':
				return "Em disputa";
				break;
			}
		});
		return $this;
	}

	private function statusPedido() {
		$this->functions['statusPedido'] = new \Twig_SimpleFunction('statusPedido', function ($status) {
			return ($status == 1) ? 'positive' : 'negative';
		});
		return $this;
	}

	private function select() {
		$this->functions['selected'] = new \Twig_SimpleFunction('selected', function ($value1, $value2) {
			return ($value1 == $value2) ? "selected='selected'" : '';
		});
		return $this;
	}

	private function fileExists() {
		$this->functions['fileExists'] = new \Twig_SimpleFunction('fileExists', function ($file) {
			return file_exists($file);
		});
		return $this;
	}

	private function avaliacoes() {
		$this->functions['avaliacoes'] = new \Twig_SimpleFunction('avaliacoes', function ($id) {
			$avaliacoesRepository = new AvaliacoesRepository;
			return $avaliacoesRepository->totalAvaliacoesProduto($id);
		});
		return $this;
	}

	private function estrelas() {
		$this->functions['estrelas'] = new \Twig_SimpleFunction('estrelas', function ($id) {
			$stars = new RatingStars;
			return $stars->media($id);
		});
		return $this;
	}

	private function estaNoCarrinho() {
		$this->functions['estaNoCarrinho'] = new \Twig_SimpleFunction('estaNoCarrinho', function ($id) {
			$statusCarrinho = new StatusCarrinho();
			return $statusCarrinho->produtoEstaNoCarrinho($id);
		});
		return $this;
	}

	public function run() {
		$this->siteUrl()
			->listarCategorias()
			->listarMarcas()
			->listarNovidades()
			->listarProdutosPromocao()
			->breadCrumb()
			->totalComFrete()
			->valorProdutosCarrinho()
			->numeroProdutosCarrinho()
			->logado()
			->dadosUser()
			->errorField()
			->persistInput()
			->flashMessage()
			->estoque()
			->statusPagamento()
			->statusPedido()
			->select()
			->avaliacoes()
			->estrelas()
			->estaNoCarrinho()
			->fileExists();
	}

}