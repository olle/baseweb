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
 * @created 2009-06-21
 */
final class Baseweb_Result implements ArrayAccess, IteratorAggregate {
	
	// VARIABLES
	
	protected $data = array();
	
	// CONSTRUCTOR
	
	public function __construct($data = array()) {		
			
		foreach ($data as $k => $v) {
			if (is_array($v))
				$this->data[$k] = new Baseweb_Result($v);
			else
				$this->data[$k] = $v;
		}
	}
	
	// PUBLIC METHODS
	
	public function __get($key) {

		if (array_key_exists($key, $this->data))
			return $this->data[$key];
		else
			return null;
	}
	
	public function __set($key, $value) {

		$this->data[$key] = $value;
	}
	
	public function __toString() {
		
		return print_r($this, true);
	}
	
	public function count() {
		
		return count($this->data);
	}
	
	// @implements ArrayAccess
	
	public function offsetExists($offset) {
		return isset($this->data[$offset]);
	}
	
	public function offsetGet($offset) {
		return $this->data[$offset];
	}
	
	public function offsetSet($offset, $value) {
		$this->data[$offset] = $value;
	}
	
	public function offsetUnset($offset) {
		unset($this->data[$offset]);
	}
	
	// @implements IteratorAggregate
	
	public function getIterator() {
		return new ArrayIterator($this->data);
	}
}
