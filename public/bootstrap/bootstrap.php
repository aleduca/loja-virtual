<?php
use App\Classes\AddFunctionsTwig;
use App\Classes\Bind;
use App\Classes\CarrinhosAbandonados;
use App\Classes\FunctionsTwig;
use App\Classes\Parameters;
use App\Classes\RetornaEstoque;
use App\Classes\Session;
use App\Classes\Template;

Session::start();

date_default_timezone_set('America/Sao_Paulo');

// Inicia o template
$template = new Template;
$twig = $template->init();

// funcoes criadas para usar no template
$functionsTwig = new FunctionsTwig;
$functionsTwig->run();

// adicionando as funcoes para funcionar no template
$addFunctionsTwig = new AddFunctionsTwig();
$addFunctionsTwig->run($twig, $functionsTwig);

// Controle de usuarios online
$userOnline = new App\Classes\UsersOnline;
$userOnline->run();

// Verifica os carrinhos abandonados
CarrinhosAbandonados::remove(new RetornaEstoque());

/**
 * Chamando o controller digitado na url
 * http://localhost:8888/controller
 */
$callController = new App\Controllers\Controller;
$calledController = $callController->controller();
$controller = new $calledController();

// Metodos vindos do baseController estendido em cada controller
Bind::bind('twig', $twig);
/**
 * Chamando o metodo digitado na url
 *  http://localhost:8888/controller/metodo
 */
$callMethod = new App\Controllers\Method;
$method = $callMethod->method($controller);

/**
 * Chamando o controller atraves da classe controller e da classe method
 */
$parameters = new Parameters;
$parameter = $parameters->getParameterMethod($controller, $method);
$controller->$method($parameter);