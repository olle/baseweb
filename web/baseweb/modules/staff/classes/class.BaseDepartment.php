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
abstract class BaseDepartment extends Doctrine_Record {

	// PUBLIC METHODS
	
	public function setUp() {
		
		$this->actAs('Sortable');
		
		$this->hasMany('StaffMember as members', array(
				'local' => 'department_id',
				'foreign' => 'member_id',
				'refClass' => 'StaffMembers'
		));
	}
	
	public function setTableDefinition() {

		$this->setTableName('staff_department');

		$this->hasColumn('id', 'integer', null, array(
				'primary' => true,
				'notnull' => true,				
				'autoincrement' => true,
		));
		
		$this->hasColumn('name', 'string', 100, array(
				'type' => 'string',
				'length' => 100,
				'default' => '',
				'notnull' => true,
				'notblank' => true,
				));
								
		$this->hasColumn('status', 'integer', 1, array(
				'length' => 1,
				'unsigned' => true,
				'default' => '1',
				'notnull' => true,
		));
	}
}
