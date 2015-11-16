<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.1
 * @created 2009-09-25
 */
interface Updatable {

	/**
	 * Must implement actual update from a currently installed, running version
	 * to the specified target update version.
	 * 
	 * Updates versions are 3-digit numbers denoting major, minor and patch
	 * version. For example, the version 2.1.3 would be 213.
	 * 
	 * @param int $toVersion Target update version number.
	 */	
	public function update($toVersion);
}
