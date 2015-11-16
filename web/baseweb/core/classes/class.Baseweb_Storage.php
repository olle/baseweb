<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-06-21
 */
abstract class Baseweb_Storage implements Storage {

	// VARIABLES
	
	protected $isAdmin;
	
	// CONSTRUCTOR
	
	public function __construct($isAdmin = false) {
		$this->isAdmin = $isAdmin;
	}
	
	// PUBLIC METHODS
	
	public function setAdmin($isAdmin) {
		$this->isAdmin = $isAdmin;
	}
}

