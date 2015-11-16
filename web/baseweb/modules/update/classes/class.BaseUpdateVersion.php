<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.1
 * @created 2009-09-25
 */
abstract class BaseUpdateVersion extends Doctrine_Record {

	// PUBLIC METHODS

	public function setUp() {
		$this->actAs('Timestampable');
		$this->hasMany('UpdateModule as modules', array(
				'local' => 'version_id',
				'foreign' => 'module_id',
				'refClass' => 'UpdateModules'
		));
	}
	
	public function setTableDefinition() {
		$this->setTableName('update_version');
		$this->hasColumn('id', 'integer', null, array(
				'primary' => true,
				'notnull' => true,
				'autoincrement' => true,
		));
		$this->hasColumn('number', 'string', 5, array(
				'type' => 'string',
				'length' => 5,
				'fixed' => false,
		));
	}
}
