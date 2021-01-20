<?php

namespace App\Controllers\Site;

use App\Classes\Helpers\RatingStars;
use App\Classes\Helpers\Redirect;
use App\Classes\User;
use App\Controllers\BaseController;
use App\Models\Site\AvaliacoesModel;
use App\Models\Site\ProdutoModel;
use App\Models\Site\UserModel;
use App\Repositories\Site\AvaliacoesRepository;

class AvaliacoesController extends BaseController {

	public function index($params) {

		$produto = new ProdutoModel();
		$produtoEncontrado = $produto->find('produto_slug', $params[0]);

		$redirect = new Redirect();
		if (!$produtoEncontrado) {
			return $redirect->redirect('/');
		}

		$avaliacoesRepository = new AvaliacoesRepository();
		$avaliacoesEncontradas = $avaliacoesRepository->listarTodasAvaliacoes($produtoEncontrado->id);

		$dados = [
			'titulo' => 'Avaliações do produto',
			'avaliacoes' => $avaliacoesEncontradas,
			'produto' => $produtoEncontrado,
			'ratingStars' => new RatingStars(),
		];

		$template = $this->twig->loadTemplate('site_avaliacoes.html');
		$template->display($dados);
	}

	public function avaliarComEstrelas() {

		$user = new User;
		$dadosUser = $user->user(new UserModel);

		if (!$dadosUser) {
			echo json_encode('NaoLogado');
			die();
		}

//        pega os dados da avaliacao com estrelas, no caso o id do produto e o numero de estrelas
		$data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
		$explodeData = explode(',', $data);

//        verifica se cliente ja avaliou esse produto, se avaliou atualiza, se nao, cadastra

		$avaliacoesRepository = new AvaliacoesRepository();
		$avaliouProduto = $avaliacoesRepository->verificaSeClienteAvaliouProduto($explodeData[1], $dadosUser->id);

		$avaliacoesModel = new AvaliacoesModel();
		if ($avaliouProduto) {
			$avaliacoesModel->update(
				$explodeData[0],
				$avaliouProduto->id
			);
			echo json_encode('atualizou');
		} else {
			$avaliacoesModel->create([
				$explodeData[1],
				$dadosUser->id,
				$explodeData[0],
			]);
			echo json_encode('avaliou');
		}
	}

}
