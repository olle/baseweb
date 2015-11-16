<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-07-01
 */
final class Baseweb_Params {
	
	// VARIABLES
	
	private $params;
	
	// CONSTRUCTOR
	
	public function __construct($params, $defaults = array()) {
		
		$this->params = array_merge($defaults, $params);
	}
	
	public function __get($key) {
		
		if (array_key_exists($key, $this->params))
			return $this->params[$key];
		else
			return null;
	}
}
