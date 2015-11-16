<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.x
 * @created 2009-07-04
 */
abstract class BaseTrack extends Doctrine_Record {

	// PUBLIC METHODS
	
	public function setUp() {
		
		parent::setUp();
		
		$this->actAs('Timestampable');
		
		$this->hasOne('Visitor', array(
				'local' => 'visitor_id',
				'foreign' => 'id',
		));
	}
	
	public function setTableDefinition() {

		$this->setTableName('tracking_tracks');

		$this->hasColumn('visitor_id', 'integer');
		
		$this->hasColumn('archived', 'boolean', null, array(
				'notnull' => true,
				'default' => false,
		));
	}
}
