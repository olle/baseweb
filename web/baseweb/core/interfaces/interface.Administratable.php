<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-05-18
 */
interface Administratable {

	/**
	 * @return The real file path to the administratable module
	 */
	public function getModulePath();
	
	/**
	 * @return The plain-text name of the administratable
	 */
	public function getTitle();
	
	/**
	 * @return A list of actions available for this administratable.
	 */
	public function getActions();
}
