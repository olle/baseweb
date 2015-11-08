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
 * @created 2009-05-18
 */
class StaffAdmin extends Baseweb_AdminModule implements Ajaxable {
	
	const TYPE_EMPLOYEE = 'Employee';
	const TYPE_DEPARTMENT = 'Department';
	const TYPE_STAFF_MEMBER = 'StaffMember';
	const TYPE_STAFF_MEMBERS = 'StaffMembers';

	const ACTION_SORT = 'sort';
	const ACTION_ADD_MEMBERSHIP = 'addMembership';
	const ACTION_REMOVE_MEMBERSHIP = 'removeMembership';
	const ACTION_RENAME_MEMBERSHIP = 'renameMembership';
	
	const DIRECTION_UP = 'up';
	const DIRECTION_DOWN = 'down';

	// VARIABLES
	
	protected $name = Staff::MODULE_NAME;	
	protected $title = 'Staff';
	protected $path;

	// CONSTRUCTOR
	
	public function __construct() {
		
		parent::__construct();
		$this->path = dirname(__FILE__);
	}

	// PUBLIC METHODS

	/*
	 * @implements Installable#getModels()
	 */
	public function getModels() {
		return array(
				self::TYPE_EMPLOYEE,
				self::TYPE_DEPARTMENT,
				self::TYPE_STAFF_MEMBER,
				self::TYPE_STAFF_MEMBERS,
		);
	}

	/*
	 * @implements Servable#doGet()
	 */
	public function doGet(Baseweb_Result $result = null) {

		if (!$result)
			$result = new Baseweb_Result();

		$result->departments = $this->storage->getDepartments();
		$result->employees = $this->storage->getEmployees();

		return $result;
	}

	/*
	 * @implements Servable#doPost()
	 */
	public function doPost(Baseweb_Result $result = null) {

		if (!$result)
			$result = new Baseweb_Result();
		
		if (!empty($_POST['action']))
			$action = strval($_POST['action']);
		else
			$action = strval($_GET['action']);
		
		if (isset($_POST['type']))
			$type = strval($_POST['type']);
		else
			$type = strval($_GET['type']);
		
		if ($action == self::ACTION_NEW) {
			
			$object = new $type();
		
		} else if ($action == self::ACTION_EDIT) {
			
			if ($type == self::TYPE_EMPLOYEE)
				$object = $this->storage->getEmployee($_POST['id']);
			else if ($type == self::TYPE_DEPARTMENT)
				$object = $this->storage->getDepartment($_POST['id']);
			
		} else if ($action == self::ACTION_SAVE) {
			
			if ($type == self::TYPE_EMPLOYEE) {
				
				if ($_POST['id'])
					$object = $this->storage->getEmployee($_POST['id']);
				else 
					$object = new Employee();
				
			} else if ($type == self::TYPE_DEPARTMENT) {
				
				if ($_POST['id'])
					$object = $this->storage->getDepartment($_POST['id']);
				else
					$object = new Department();
			}
				
			$object->merge($_POST);
			
			if (!$object->isValid()) {
				$result->errors = $object->getErrorStack();
			} else {
				$object->save();
			}
			
		} else if ($action == self::ACTION_DELETE) {
			
			if ($type == self::TYPE_EMPLOYEE)
				$object = $this->storage->getEmployee($_POST['id']);
			else if ($type == self::TYPE_DEPARTMENT)
				$object = $this->storage->getDepartment($_POST['id']);

			if ($object && $object->delete())
				unset($object);
	
		} else if ($action == self::ACTION_SORT) {
			
			if ($type == self::TYPE_DEPARTMENT) {

				$identity = split('-', strval($_POST['id']));
				$object = $this->storage->getDepartment(intval($identity[1]));

			} else if ($type == self::TYPE_EMPLOYEE) {

				$identity = split('-', strval($_POST['id']));
				$object = $this->storage->getEmployee(intval($identity[1]));

			} else if ($type == self::TYPE_STAFF_MEMBER) {
				
				$identity = split('-', strval($_POST['id']));
				$object = $this->storage->getStaffMember(intval($identity[1]), intval($identity[2]));
				$target = $this->storage->getDepartment(intval($identity[2]));
				$type = self::TYPE_DEPARTMENT;
			}
			
			$direction = strval($_POST['direction']);
			
			if ($direction == self::DIRECTION_UP)
				$object->moveUp();
			else
				$object->moveDown();
				
			$object->save();
			
			if (isset($target))
				$object = $this->storage->getDepartment($target->id);
			else
				unset($object);
	
		} else if ($action == self::ACTION_REMOVE_MEMBERSHIP) {

			$employee = $this->storage->getEmployee(intval($_POST['employee_id']));
			$department = $this->storage->getDepartment(intval($_POST['department_id']));			

			$member = $this->storage->getStaffMember($employee->id, $department->id);
			$member->delete();
			
			if ($type == self::TYPE_EMPLOYEE)
				$object = $employee;
			else
				$object = $department;

		} else if ($action == self::ACTION_RENAME_MEMBERSHIP) {

			$employee = $this->storage->getEmployee(intval($_POST['employee_id']));
			$department = $this->storage->getDepartment(intval($_POST['department_id']));			

			$member = $this->storage->getStaffMember($employee->id, $department->id);

			if ($member) {
				$member->title = strval($_POST['title']);
				$member->save();
			}

			if ($type == self::TYPE_EMPLOYEE)
				$object = $employee;
			else
				$object = $department;
			
		} else if ($action == self::ACTION_ADD_MEMBERSHIP) {
			
			if ($type == self::TYPE_EMPLOYEE)
				$object = $this->storage->getEmployee(intval($_POST['id']));
			else
				$object = $this->storage->getDepartment(intval($_POST['id']));
				
			$mask = array();
			
			foreach ($object->members as $maskMember) {
				if ($type == self::TYPE_EMPLOYEE)
					$mask[] = $maskMember->Department->name;
				else
					$mask[] = $maskMember->Employee->name;
			}
					
			$names = array();
			
			$line = strval($_POST['name']);
			
			if (strpos($line, ',') !== false)
				$names = split(',', $line);
			else
				$names[] = $line;

			foreach ($names as $name) {

				if (in_array($name, $mask))
					continue;

				if ($object instanceof Employee)
					$source = $this->storage->getDepartment(strval(trim($name)));
				else
					$source = $this->storage->getEmployee(strval(trim($name)));
				
				if ($object && $source) {
					
					if ($object instanceof Employee) {

						$employee_id = $object->id;
						$department_id = $source->id;						
					} else {
						
						$department_id = $object->id;
						$employee_id = $source->id;
					}
					
					$member = new StaffMember();
					$member->employee_id = $employee_id;
					$member->department_id = $department_id;
					$member->save();
					
					$link = new StaffMembers();
					$link->member_id = $member->id;
					$link->employee_id = $employee_id;
					$link->department_id = $department_id;
					$link->save();
					
					unset($source);
				}
			}
			
		} else if ($action == self::ACTION_HELP) {
			
			$result->help = $this->getHelp();
		}

		$result->departments = $this->storage->getDepartments();
		$result->employees = $this->storage->getEmployees(null);
		
		if (isset($object) && isset($type)) {
			if ($type == self::TYPE_DEPARTMENT)
				$result->department = $object;
			else
				$result->employee = $object;
		}
		
		return $result;
	}
	
	/**
	 * @implements Administratable#getActions()
	 */
	public function getActions() {
		return array(
				'New employee' => array('action' => 'new', 'type' => self::TYPE_EMPLOYEE),
				'New department' => array('action' => 'new', 'type' => self::TYPE_DEPARTMENT),
		);
	}
	
	/*
	 * @implements Ajaxable#getAjaxURL()
	 */
	public function getAjaxURL() {
		return '/baseweb/modules/staff/staff-ajax.php';
	}
}