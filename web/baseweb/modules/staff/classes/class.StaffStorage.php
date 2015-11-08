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
class StaffStorage extends Baseweb_Storage {
	
	// CONSTRUCTOR
	
	public function __construct() {

		parent::__construct();		
	}
	
	// PUBLIC METHODS
	
	public function getStaffCount($asMixed = false) {

		if (!$asMixed)
			return $this->getEmployeeCount($asMixed);

		return new Baseweb_Result(array(
			'departments' => $this->getDepartmentCount($asMixed),
			'employees' => $this->getEmployeeCount($asMixed),
		));
	}
	
	/*
	 * @alias #getDepartments(...)
	 */
	public function getStaff($page = 1, $limit = null, $asMixed = false) {
		
		return $this->getDepartments($page, $limit, $asMixed);
	}
	
	public function getDepartmentCount($asMixed = false) {

		$q = new Doctrine_Query();
		$q->from('Department d');
		
		if (!$this->isAdmin) {
			$q->where('d.status > ?', 0);
			return $q->count();
		}

		if ($asMixed) {
			return new Baseweb_Result(array(
				'total' => $total = $q->count(),
				'active' => $active = $q->where('d.status > ?', 0)->count(),
				'inactive' => $total - $active,
			));
		}
		
		return $q->count();
	}
	
	public function getDepartments($page = 1, $limit = null, $asMixed = false) {
		
		$q = new Doctrine_Query();
		$q->from('Department d');
		$q->leftJoin('d.members m');
		$q->leftJoin('m.Employee e');
		
		if (!$this->isAdmin) {
			$q->where('d.status > ?', 0);
			$q->andWhere('e.status > ?', 0);
		}
			
		$q->orderBy('d.position ASC, m.position ASC');
		
		$p = new Doctrine_Pager($q, $page, $limit);
		
		if ($asMixed) {
			return new Baseweb_Result(array(
				'items' => $p->execute(),
				'pager' => $p
			));
		} else {
			return $p->execute();
		}		
	}
	
	public function getDepartment($key = null) {
		
		$q = new Doctrine_Query();
		$q->from('Department d');
		$q->leftJoin('d.members m');
		$q->leftJoin('m.Employee e');
		
		$q->where('1=1');
		
		if (!$this->isAdmin) {
			$q->andWhere('d.status > ?', 0);
			$q->andWhere('e.status > ?', 0);
		}
		
		if ($key && intval($key)) {
			$q->andWhere('d.id = ?', intval($key));
		} else if ($key) {
			$q->andWhere('d.name = ?', strval($key));
		}
		
		$q->orderBy('m.position ASC');

		$q->limit(1);
		$department = $q->execute();
		
		return $department->count() > 0 ? $department->get(0) : null;
	}
	
	public function getEmployeeCount($asMixed = false) {
		
		$q = new Doctrine_Query();
		$q->from('Employee e');
		
		if (!$this->isAdmin) {
			$q->where('e.status > ?', 0);
			return $q->count();
		}

		if ($asMixed) {
			return new Baseweb_Result(array(
				'total' => $total = $q->count(),
				'active' => $active = $q->where('e.status > ?', 0)->count(),
				'inactive' => $total - $active,
			));
		}
		
		return $q->count();		
	}
	
	public function getEmployees($page = 1, $limit = null, $asMixed = false) {

		$q = new Doctrine_Query();
		$q->from('Employee e');
		$q->leftJoin('e.members m');
		$q->leftJoin('m.Department d');
		
		if (!$this->isAdmin) {
			$q->where('e.status > ?', 0);
			$q->andWhere('d.status > ?', 0);
		}
			
		$q->orderBy('e.position ASC, e.name');
			
		$p = new Doctrine_Pager($q, $page, $limit);
		
		if ($asMixed) {
			return new Baseweb_Result(array(
				'items' => $p->execute(),
				'pager' => $p,
			));
		} else {
			return $p->execute();
		}				
	}
	
	public function getEmployee($key = null) {
		
		$q = new Doctrine_Query();
		$q->from('Employee e');
		$q->leftJoin('e.members m');
		$q->leftJoin('m.Department d');

		$q->where('1=1');
		
		if (!$this->isAdmin) {
			$q->andWhere('e.status > ?', 0);
			$q->andWhere('d.status > ?', 0);
		}
		
		if ($key && intval($key)) {
			$q->andWhere('e.id = ?', intval($key));
		} else if ($key) {
			$q->andWhere('e.name = ?', strval($key));
		}
		
		$q->limit(1);		
		$employee = $q->execute();
		
		return $employee->count() > 0 ? $employee->get(0) : null;		
	}
	
	public function getStaffMember($employeeId, $departmentId = null) {
		
		$q = new Doctrine_Query();
		$q->from('StaffMember');
		$q->where('1=1');

		if (func_num_args() == 1) {			
			// Single param is really id
			$q->andWherE('id = ?', $employeeId);
		} else {			
			$q->andWhere('employee_id = ?', $employeeId);
			$q->andWhere('department_id = ?', $departmentId);			
		}
		
		$q->limit(1);
		$staffMember = $q->execute();
		
		return $staffMember->count() > 0 ? $staffMember->get(0) : null;
	}
}
