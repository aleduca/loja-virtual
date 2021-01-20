<?php

use App\Repositories\Site\ProdutoRepository;
use App\Classes\BreadCrumb;
use App\Models\Site\MarcaModel;
use App\Models\Site\UserModel;
use App\Models\Site\CategoriaModel;
use App\Repositories\Site\ProdutosCarrinhoRepository;
use App\Classes\Carrinho;
use App\Classes\CarrinhoBanco;
use App\Classes\Frete;
use App\Classes\Logado;
use App\Classes\ErrorsValidate;
use App\Classes\PersistInput;
use App\Classes\FlashMessage;
use App\Classes\Estoque;

$site_url = new \Twig_SimpleFunction('site_url', function() {
    return 'http://' . $_SERVER['SERVER_NAME'] . ':8888';
});

// Listar as categorias no left menu
$categorias = new \Twig_SimpleFunction('categorias', function() {
    $categoriaModel = new CategoriaModel();
    return $categoriaModel->fetchAll();
});

// listar as marcas
$marcas = new \Twig_SimpleFunction('marcas', function() {
    $marcaModel = new MarcaModel();
    return $marcaModel->fetchAll();
});

// Listar as novidades no right menu
$novidade = new \Twig_SimpleFunction('novidade', function() {
    $produtoRepository = new ProdutoRepository;
    return $produtoRepository->ultimoProdutoAdicionado();
});


// Listar produto em promocao
$promocao = new \Twig_SimpleFunction('promocao', function() {
    $produtoRepository = new ProdutoRepository;
    return $produtoRepository->listarProdutosPromocao(1);
});


// breadCrumb
$breadCrumb = new \Twig_SimpleFunction('breadCrumb', function() {
    $breadCrumb = new BreadCrumb();
    return $breadCrumb->createBreadCrumb();
});


// total dos produtos no carrinho
$valorProdutosCarrinho = new \Twig_SimpleFunction('valorProdutosCarrinho', function() {
    $produtosCarrinhoRepository = new ProdutosCarrinhoRepository();
    return $produtosCarrinhoRepository->totalProdutoscarrinho();
});


// numero de produtos no carrinho
$numeroProdutosCarrinho = new \Twig_SimpleFunction('numeroProdutosCarrinho', function() {
    return Carrinho::produtosCarrinho();
});

$totalComfrete = new \Twig_SimpleFunction('totalComfrete', function() {

    $frete = new Frete();
    $valorFrete = $frete->pegarFrete();

    $carrinho = new ProdutosCarrinhoRepository();
    $totalCompra = $carrinho->totalProdutoscarrinho();

    return $valorFrete + $totalCompra;
});

// verifica se usuario esta logado
$logado = new \Twig_SimpleFunction('logado', function() {
    return Logado::logado();
});

// pegar dados do usuario
$user = new \Twig_SimpleFunction('user', function() {
    $userModel = new UserModel;
    return $userModel->find('id', $_SESSION['id']);
});

// mensagens de erro do formulario
$errorField = new \Twig_SimpleFunction('errorField', function($field) {
    return ErrorsValidate::show($field);
});

// persistir os dados no formulario
$persist = new \Twig_SimpleFunction('persist', function($field) {
    $persist = new PersistInput();
    return $persist->show($field);
});

// mostrar mensagens no template
$flash = new \Twig_SimpleFunction('flash', function($index) {
    $flash = new FlashMessage();
    return $flash->show($index);
});

// estoque dos produtos
$estoque = new \Twig_SimpleFunction('estoque', function($id) {
    $estoque = new Estoque;
    return $estoque->estoqueAtual($id);
});

// estoque dos produtos
$statusPagamento = new \Twig_SimpleFunction('statusPagamento', function($status) {
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

$statusPedido = new \Twig_SimpleFunction('statusPedido', function($status) {
   if($status == 1){
    return 'positive';
   }
   return 'negative';
});
