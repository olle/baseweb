<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-06-22
 */
abstract class BaseStaffMember extends Doctrine_Record {
				
	public function setUp() {

		$this->actAs('Sortable', array('manyListsColumn' => 'department_id'));
		
		$this->hasOne('Employee', array(
				'local' => 'employee_id', 
				'foreign' => 'id',
				'onDelete' => 'CASCADE',
		));
		
		$this->hasOne('Department', array(
				'local' => 'department_id',
				'foreign' => 'id',
				'onDelete' => 'CASCADE',
		));
	}
	
	public function setTableDefinition() {

		$this->setTableName('staff_member');

		$this->hasColumn('id', 'integer', null, array(
				'notnull' => true,
				'autoincrement' => true,
				'primary' => true,
		));
		
		$this->hasColumn('employee_id', 'integer', null, array(
				'notnull' => true,
		));
		
		$this->hasColumn('department_id', 'integer', null, array(
				'notnull' => true,
		));
		
		$this->hasColumn('title', 'string', 50, array(
		));
	}
}
