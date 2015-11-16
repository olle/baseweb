<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-06-19
 */
interface Servable {
	
	/**
	 * Must ensure to process the current POST request sent by the browser.
	 * @return the results for further handling.
	 * @param object $result[optional]
	 */
	public function doPost(Baseweb_Result $result = null);	
	
	/**
	 * Must ensure to process the current GET reqeust sent by the browser.
	 * @return the results for further handling.
	 * @param object $result[optional]
	 */
	public function doGet(Baseweb_Result $result = null);
}
