<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-06-22
 */
abstract class BaseEmployeesOfDepartments extends Doctrine_Record {

	// PUBLIC METHODS
	
	public function setUp() {
		
		$this->hasOne('Department', array(
				'local' => 'department_id',
				'foreign' => 'id',
				'onDelete' => 'CASCADE'
		));

		$this->hasOne('Employee', array(
				'local' => 'employee_id',
				'foreign' => 'id',
				'onDelete' => 'CASCADE'
		));
	}
	
	public function setTableDefinition() {
		
		$this->setTableName('staff_employees_of_departments');
		
        $this->hasColumn('employee_id', 'integer', null, array(
				'notnull' => true,
                'primary' => true
        ));

        $this->hasColumn('department_id', 'integer', null, array(
				'notnull' => true,
                'primary' => true
        ));
		
		$this->hasColumn('title', 'string', 50, array(
				'length' => 50,
		));
	}	
}