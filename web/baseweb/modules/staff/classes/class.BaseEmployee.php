<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-06-22
 */
abstract class BaseEmployee extends Doctrine_Record {

	// PUBLIC METHODS
	
	public function setUp() {
		$this->actAs('Sortable');
        $this->actAs('Sluggable', array(
                'unique'    => true,
                'fields'    => array('name'),
                'canUpdate' => true
            )
        );		
		$this->hasMany('StaffMember as members', array(
				'local' => 'employee_id',
				'foreign' => 'member_id',
				'refClass' => 'StaffMembers',
		));		
	}	
	
	public function setTableDefinition() {
		$this->setTableName('staff_employee');
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
		$this->hasColumn('title', 'string', 50, array(
				'type' => 'string',
				'length' => 50,
				'default' => '',
				'notnull' => true,
				'notblank' => true,
		));
		if (Baseweb::getSettings()->APP_DEBUG) {
      $this->hasColumn('email', 'string', 255, array(
          'email' => false,
      ));
		} else {
      $this->hasColumn('email', 'string', 255, array(
          'email' => true,
      ));		
		}
		$this->hasColumn('phone', 'string', 30, array(
				'type' => 'string',
				'length' => 30,
				'default' => '',
				'notnull' => true,
		));
		$this->hasColumn('mobile', 'string', 30, array(
				'type' => 'string',
				'length' => 30,
				'default' => '',
				'notnull' => true,
		));
		$this->hasColumn('status', 'integer', 1, array(
				'type' => 'integer',
				'length' => 1,
				'unsigned' => true,
				'default' => '1',
				'notnull' => true,
		));
		$this->hasColumn('image', 'string', null, array(
				'notnull' => true,
				'default' => '',
		));
	}
}
