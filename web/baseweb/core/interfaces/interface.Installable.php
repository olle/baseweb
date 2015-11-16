<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-05-18
 */
interface Installable {
	
	/**
	 * @return An array with class names of the installable's models
	 */
	public function getModels();
	
	/**
	 * Must perform the applicable installation to ensure that the implementing
	 * module is properly installed.
	 * @param boolean $addTestdata
	 */
	public function install($withFixtures);
}
