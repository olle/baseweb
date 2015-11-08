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
 * @created 2009-06-19
 */
class Staff extends Baseweb_Module implements Servable {
	
	const MODULE_NAME = 'staff';
	
	// VARIABLES
	
	protected $name = self::MODULE_NAME;
		
	// PUBLIC METHODS

	/*
	 * @implements Servable#doGet(...)
	 */
	public function doGet(Baseweb_Result $result = null) {
		
		if (!$result)
			$result = new Baseweb_Result();
	
		$result->staff = $this->getStaff();
		
		return $result;
	}
	
	/*
	 * @implements Servable#doPost(...)
	 */
	public function doPost(Baseweb_Result $result = null) {

		if (!$result)
			$result = new Baseweb_Result();
			
		// TODO: Implement public actions for POST here
			
		return $result;
	}

	/**
	 * @param object $params[optional]
	 * @param 'mixed' Boolean if result should be mixed or plain value
	 */
	public function getStaffCount($params = array()) {
		
		$p = new Baseweb_Params($params, array('mixed' => false));
		
		return $this->storage->getStaffCount($p->mixed);
	}

	/**
	 * @param object $params[optional]
	 */	
	public function getStaff($params = array()) {

		return $this->getDepartments($params);		
	}

	/**
	 * @param object $params[optional]
	 * @param 'mixed' Boolean if result should be mixed or plain value
	 */
	public function getDepartmentCount($params = array()) {
		
		$p = new Baseweb_Params($params, array('mixed' => false));
		return $this->storage->getDepartmentCount($p->mixed);
	}
	
	/**
	 * @param object $params[optional]
	 * @param 'mixed' Boolean if result should be mixed or plain list.
	 */
	public function getDepartments($params = array()) {
		
		$p = new Baseweb_Params($params, array('page' => 1, 'limit' => null, 'mixed' => false));
		return $this->storage->getDepartments($p->page, $p->limit, $p->mixed);
	}

	/**
	 * @param object $params[optional]
	 */
	public function getDepartment($params = array()) {

		if (!is_array($params))
			$p = new Baseweb_Params(array('key' => $params));
		else
			$p = new Baseweb_Params($params, array('key' => null));
			
		return $this->storage->getDepartment($p->key);
	}
	
	public function getEmployeeCount($params = array()) {
		
		$p = new Baseweb_Params($params, array('mixed' => false));
		return $this->storage->getEmployeeCount($p->mixed);
	}
	
	public function getEmployees($params = array()) {
		
		$p = new Baseweb_Params($params, array('page' => 1, 'limit' => null, 'mixed' => false));
		return $this->storage->getEmployees($p->page, $p->limit, $p->mixed);
	}
	
	public function getEmployee($params = array()) {
		
		if (!is_array($params))
			$p = new Baseweb_Params(array('key' => $params));
		else
			$p = new Baseweb_Params($params, array('key' => null));
			
		return $this->storage->getEmployee($p->key);
	}
}
