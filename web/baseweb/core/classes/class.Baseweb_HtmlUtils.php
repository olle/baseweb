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
