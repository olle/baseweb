<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.1
 * @created 2009-09-25
 */
abstract class BaseUpdateModule extends Doctrine_Record {

	// PUBLIC METHODS

	public function setUp() {
		$this->actAs('Timestampable');
		$this->hasOne('UpdateModules', array(
				'local' => 'id',
				'foreign' => 'update_module',
		));
	}
	
	public function setTableDefinition() {
		$this->setTableName('update_module');
		$this->hasColumn('id', 'integer', null, array(
				'primary' => true,
				'notnull' => true,
				'autoincrement' => true,
		));
		$this->hasColumn('name', 'string', 50);
		$this->hasColumn('migration', 'integer');
	}
}
