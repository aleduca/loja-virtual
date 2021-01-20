<?php

namespace App\Traits;

trait Cache{

	protected $redis;

	public function setRedis($redis){
	    $this->redis = $redis;
	}
	
}