<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-06-19
 */
abstract class Baseweb_HtmlUtils {
	
	// PUBLIC FUNCTIONS
	
	public function setParameters($element, $props) {
		
		if (empty($props))
			return $element;
		
		$properties = ' ';
		
		foreach ($props as $key => $value) {
			$properties .= $key . '="' . $value . '" ';
		}
		
		if (strpos($element, '/>') === false)
			return substr($element, 0, -1) . rtrim($properties) . '>';
		else
			return substr($element, 0, -2) . $properties . '/>';
	}
	
}
