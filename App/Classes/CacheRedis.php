<?php
namespace App\Classes;

use App\Classes\Cache;
use App\Classe;
use App\Repositories\Site\ProdutoRepository;

class CacheRedis extends Cache{

	const TIME = '+1day';
	private $produtosRepository;

	public function __construct($redis){
		$this->produtoRepository = new ProdutoRepository;
		parent::__construct(new Redis($redis));
	}

	public function home(){

		// dump($this->ttl('produtos')); quanto tempo vai expirar
		// $this->del('promocao_produtos'); deletar o cache pelo key

	    $this->set('produtos_destaque',json_encode(
	        $this->produtoRepository->listarProdutosOrdenadosPeloDestaque(6))
	    );
	    $this->set('produtos_promocao',json_encode($this->produtoRepository->listarProdutosPromocao(6)));
	    $this->expire('produtos_destaque',self::TIME);
	    $this->expire('produtos_promocao',self::TIME);
	}

	public function presentes(){
	    $this->set('produtos_presentes',json_encode($this->produtoRepository->listarProdutoParaPresentes()));
	    $this->expire('produtos_presentes',self::TIME);
	}

	public function destaques(){
	    $this->set('produtos_destaques',json_encode($this->produtoRepository->listarProdutosEmDestaque()));
	    $this->expire('produtos_destaques',self::TIME);
	}

}