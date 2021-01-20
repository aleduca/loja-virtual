<?php

namespace App\Classes\Forms;

use App\Classes\Container;
use App\Traits\ValidateForm;

abstract class Form extends Container {
	use ValidateForm;
}