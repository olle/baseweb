<?php
/*
 * Copyright (c) Olle Törnström studiomediatech.com 2008-2009
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
 * @created 2009-07-01
 */
final class Baseweb_Params {
	
	// VARIABLES
	
	private $params;
	
	// CONSTRUCTOR
	
	public function __construct($params, $defaults = array()) {
		
		$this->params = array_merge($defaults, $params);
	}
	
	public function __get($key) {
		
		if (array_key_exists($key, $this->params))
			return $this->params[$key];
		else
			return null;
	}
}
