<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-06-22
 */
abstract class BaseStaffMembers extends Doctrine_Record {
	
	public function setUp() {
		
		$this->hasOne('StaffMember', array(
				'local' => 'member_id',
				'foreign' => 'id',
				'onDelete' => 'CASCADE',
		));
		
		$this->hasOne('Department', array(
				'local' => 'department_id', 
				'foreign' => 'id',
				'onDelete' => 'CASCADE',
		));

		$this->hasOne('Employee', array(
				'local' => 'employee_id', 
				'foreign' => 'id',
				'onDelete' => 'CASCADE',
		));
	}
	
	public function setTableDefinition() {

		$this->setTableName('staff_members');

		$this->hasColumn('member_id', 'integer', null, array(
				'primary' => true,
				'autoincrement' => true,
				'notnull' => true,
		));
		
		$this->hasColumn('department_id', 'integer', null, array(
				'primary' => true,
				'notnull' => true,
		));
		
		$this->hasColumn('employee_id', 'integer', null, array(
				'primary' => true,
				'notnull' => true,
		));
	}
}
