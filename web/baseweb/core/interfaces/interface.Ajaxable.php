<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-06-17
 */
interface Ajaxable {
	
	/**
	 * @return The Ajax URL of the implementing module.
	 */
	public function getAjaxURL();
}