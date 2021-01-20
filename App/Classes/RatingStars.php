<?php

namespace App\Classes;

use App\Repositories\Site\AvaliacoesRepository;

class RatingStars {

	public function showStars($stars) {
		switch ($stars) {
		case 0:
			$stars = "<img src='/assets/images/site/star-empty.png' width='20'>";
			$stars .= "<img src='/assets/images/site/star-empty.png' width='20'>";
			$stars .= "<img src='/assets/images/site/star-empty.png' width='20'>";
			$stars .= "<img src='/assets/images/site/star-empty.png' width='20'>";
			$stars .= "<img src='/assets/images/site/star-empty.png' width='20'>";
			break;
		case 1:
			$stars = "<img src='/assets/images/site/star-full.png' width='20'>";
			$stars .= "<img src='/assets/images/site/star-empty.png' width='20'>";
			$stars .= "<img src='/assets/images/site/star-empty.png' width='20'>";
			$stars .= "<img src='/assets/images/site/star-empty.png' width='20'>";
			$stars .= "<img src='/assets/images/site/star-empty.png' width='20'>";
			break;
		case 2:
			$stars = "<img src='/assets/images/site/star-full.png' width='20'>";
			$stars .= "<img src='/assets/images/site/star-full.png' width='20'>";
			$stars .= "<img src='/assets/images/site/star-empty.png' width='20'>";
			$stars .= "<img src='/assets/images/site/star-empty.png' width='20'>";
			$stars .= "<img src='/assets/images/site/star-empty.png' width='20'>";
			break;
		case 3:
			$stars = "<img src='/assets/images/site/star-full.png' width='20'>";
			$stars .= "<img src='/assets/images/site/star-full.png' width='20'>";
			$stars .= "<img src='/assets/images/site/star-full.png' width='20'>";
			$stars .= "<img src='/assets/images/site/star-empty.png' width='20'>";
			$stars .= "<img src='/assets/images/site/star-empty.png' width='20'>";
			break;
		case 4:
			$stars = "<img src='/assets/images/site/star-full.png' width='20'>";
			$stars .= "<img src='/assets/images/site/star-full.png' width='20'>";
			$stars .= "<img src='/assets/images/site/star-full.png' width='20'>";
			$stars .= "<img src='/assets/images/site/star-full.png' width='20'>";
			$stars .= "<img src='/assets/images/site/star-empty.png' width='20'>";
			break;
		case 5:
			$stars = "<img src='/assets/images/site/star-full.png' width='20'>";
			$stars .= "<img src='/assets/images/site/star-full.png' width='20'>";
			$stars .= "<img src='/assets/images/site/star-full.png' width='20'>";
			$stars .= "<img src='/assets/images/site/star-full.png' width='20'>";
			$stars .= "<img src='/assets/images/site/star-full.png' width='20'>";
			break;
		}

		return $stars;
	}

	public function media($id) {
		$avalicaoesRepo = new AvaliacoesRepository;
		$media = round($avalicaoesRepo->media($id)->media);

		if (!$media) {
			return $this->showStars(0);
		}

		return $this->showStars($media);
	}

}
