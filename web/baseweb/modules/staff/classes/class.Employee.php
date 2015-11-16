<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-05-18
 */
class Employee extends BaseEmployee {

	// PUBLIC METHODS

	public function __toString() {
		
		return $this->name . ', ' . $this->title;
	}		
}
