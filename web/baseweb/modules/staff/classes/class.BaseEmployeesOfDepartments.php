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