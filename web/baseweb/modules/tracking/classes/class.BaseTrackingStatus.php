<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.x
 * @created 2009-07-03
 */
abstract class BaseTrackingStatus extends Doctrine_Record {

	// PUBLIC METHODS
	
	public function setTableDefinition() {

		$this->setTableName('tracking_status');

		$this->hasColumn('id', 'integer', null, array(
				'primary' => true,
				'autoincrement' => false,
		));
		
		$this->hasColumn('tracking', 'integer', 1, array(
				'type' => 'integer',
				'length' => 1,
				'default' => 0,
				'notnull' => true,
		));
	}
}
