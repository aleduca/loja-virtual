<?php
namespace App\Traits;

use App\Classes\Bind;

trait View {

	public function view($dados, $view) {
		$twig = Bind::get('twig');

		$view = str_replace('.', '/', $view);
		$template = $twig->loadTemplate($view . '.html');
		return $template->display($dados);
	}

}