<?php

namespace App\Controllers;

use App\Classes\Container;
use App\Traits\View;

abstract class BaseController extends Container {
	use View;

	public function __construct() {
		parent::__construct();
	}
}