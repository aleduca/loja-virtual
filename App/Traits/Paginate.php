<?php

namespace App\Traits;

use App\Classes\Bind;
use App\Classes\Uri;

trait Paginate {

	private $totalRecords;

	private $maxLinks = 4;

	private function currentPage() {

		$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);

		if (isset($page) && $page > 0) {
			return $page;
		}

		return 1;
	}

	private function offset() {
		return ($this->currentPage() * $this->perPage) - $this->perPage;
	}

	private function totalRecords() {

		$bind = Bind::get('bind');

		$bind->execute();

		return $bind->rowCount();
	}

	public function perPage($perPage) {
		$this->perPage = $perPage;
	}

	private function totalPages() {
		return ceil($this->totalRecords() / $this->perPage);
	}

	public function Sqlpaginate() {
		return " limit {$this->perPage} offset {$this->offset()}";
	}

	private function link() {

		$link = "?page=";

		if (isset($this->busca)) {
			$busca = filter_var($_GET['s'], FILTER_SANITIZE_STRING);
			$link = "?s={$busca}&page=";
		}

		return (new Uri)->getUri() . $link;

	}

	private function preview() {
		$links = '';
		if ($this->currentPage() != 1) {
			$preview = ($this->currentPage() - 1);
			// $links = '<a href="' . $this->link() . '1"> [1] </a>';
			$links .= '<a href="' . $this->link() . $preview . '" aria-label="Previous" class="previous-button"> <span aria-hidden="true"></span></a>';
		}
		return $links;
	}

	private function next() {
		$links = '';
		if ($this->currentPage() != $this->totalPages()) {
			$next = ($this->currentPage() + 1);
			$links = '<a href="' . $this->link() . $next . '" aria-label="Next" class="next-button"><span aria-hidden="true"></span></a>';
			// $links .= '<a href="' . $this->link() . $this->totalPages() . '">[' . $this->totalPages() . ']</a>';
		}

		return $links;
	}

	private function showLinks($i) {

		$class = ($i == $this->currentPage()) ? 'active' : '';
		if ($i + 1 && $i > 0 && $i <= $this->totalPages()) {
			return "<a href='" . $this->link() . $i . "' class=" . $class . ">{$i}</a>";
		}
	}

	public function links() {

		$totalPages = $this->totalPages();

		if ($totalPages > 0) {

			$links = $this->preview();
			for ($i = $this->currentPage() - $this->maxLinks; $i <= $this->currentPage() + $this->maxLinks; $i++) {
				$links .= $this->showLinks($i);
			}
			$links .= $this->next();

			return $links;
		}
	}

	public function infoPaginate() {
		return "Página {$this->currentPage()} de {$this->totalPages()}";
	}

}
