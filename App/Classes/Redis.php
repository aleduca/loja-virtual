<?php

namespace App\Classes;

use App\Interfaces\InterfaceCache;

class Redis implements InterfaceCache{
	
	private $redis;
	const TIME_EXPIRE = '+1day';

	public function __construct($redis){
		$this->redis = $redis;
	}

	public function set($key, $value){
		$this->redis->set($key,json_encode($value));	
	}

	public function get($key){
		return json_decode($this->redis->get($key));
	}

	public function expire($key){
		return $this->redis->expireat($key,strtotime(self::TIME_EXPIRE));	
	}

	public function toExpire($key){
		return $this->redis->ttl($key);	
	}

	public function incr($id){
		return $this->redis->incr($id);
	}
}