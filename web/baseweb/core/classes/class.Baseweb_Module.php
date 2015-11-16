<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-06-19
 */
abstract class Baseweb_Module implements Module {

	// VARIABLES
	
	protected $storage;
	protected $storages;

	// CONSTRUCTOR
	
	public function __construct() {
		
		$classname = ucfirst($this->getName()) . 'Storage';
		
		if (class_exists($classname)) {
			$this->storage = new $classname;
			$this->storage->setAdmin(false);
		}
	}
	
	// PUBLIC METHODS

	public function getName() {
		return $this->name;
	}
}
