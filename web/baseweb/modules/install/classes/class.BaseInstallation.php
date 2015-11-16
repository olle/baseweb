<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-06-21
 */
abstract class BaseInstallation extends Doctrine_Record {

	// PUBLIC METHODS
	
	public function setTableDefinition() {

		$this->setTableName('install_installation');
		
		$this->hasColumn('key', 'string', 50, array(
				'type' => 'string',
				'length' => 50,
				'fixed' => false,
				'primary' => true,
				'default' => '',
				'notnull' => true,
				'autoincrement' => false,
				));
				
		$this->hasColumn('value', 'string', 200, array(
				'type' => 'string',
				'length' => 200,
				'fixed' => false,
				'primary' => false,
				'default' => '',
				'notnull' => true,
				'autoincrement' => false,
				));
	}
}
