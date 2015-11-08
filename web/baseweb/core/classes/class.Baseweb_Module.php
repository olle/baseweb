<?php
/*
 * Copyright (c) Olle Törnström studiomediatech.com 2009
 *
 * THIS CODE IS PROPRIETARY AND PROTECTED BY COPYRIGHT LAW AGAINST COPYING,
 * RE-DISTRIBUTION, PUBLISHING OR DE-COMPILATION WITHOUT THE PRIOR WRITTEN
 * CONSENT OF THE AUTHOR. USAGE IS CONTROLLED BY A LICENSE AGREEMENT,
 * REGULATING THE SPECIFIC, UNIQUE, NON EXCLUSIVE RIGHTS TO RUN, USE OR
 * INCLUDE THE CODE IN WHOLE, PART, COMPILED OR DECOMPILED FORM.
 */
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
