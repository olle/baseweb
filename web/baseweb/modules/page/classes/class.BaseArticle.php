<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.2
 * @created 2009-09-23
 */
abstract class BaseArticle extends Doctrine_Record {

	// PUBLIC METHODS

	public function setUp() {
		$this->hasOne('Slot', array(
			'local' => 'id',
			'foreign' => 'article_id',
		));		
	}
	
	public function setTableDefinition() {
		$this->setTableName('articles');
		$this->hasColumn('id', 'integer', 11, array(
				'length' => 11,
				'unsigned' => 1,
				'primary' => true,
				'autoincrement' => true,
		));		
		$this->hasColumn('content', 'clob');		
	}
}
