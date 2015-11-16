<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-06-17
 */
interface Module {
	
	/**
	 * @return A path-safe unique module name
	 */
	public function getName();
}