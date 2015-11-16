<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.1
 * @created 2009-09-25
 */
abstract class BaseUpdateModules extends Doctrine_Record {

	public function setUp() {
		$this->hasOne('UpdateVersion', array(
				'local' => 'version_id',
				'foreign' => 'id',
				'onDelete' => 'CASCADE',
		));
		$this->hasOne('UpdateModule', array(
				'local' => 'module_id', 
				'foreign' => 'id',
				'onDelete' => 'CASCADE',
		));
	}

	public function setTableDefinition() {
		$this->setTableName('update_modules');
		$this->hasColumn('version_id', 'integer');
		$this->hasColumn('module_id', 'integer');
	}
}
