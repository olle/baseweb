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
 * @since 2.2
 * @created 2009-09-22
 */
abstract class BaseSlot extends Doctrine_Record {

	// PUBLIC METHODS

	public function setUp() {
		$this->hasOne('Article', array(
			'local' => 'article_id',
			'foreign' => 'id',
		));
	}
	
	public function setTableDefinition() {
		$this->setTableName('slots');
		$this->hasColumn('id', 'integer', 11, array(
				'length' => 11,
				'unsigned' => 1,
				'primary' => true,
				'autoincrement' => true,
		));		
		$this->hasColumn('address', 'string', 255);		
		$this->hasColumn('name', 'string', 40);
		$this->hasColumn('article_id', 'integer', 11, array(
				'length' => 11,
				'unsigned' => 1,
		));	
		$this->index('unq_address_name', array(
				'fields' => array('address', 'name'),
				'type' => 'unique'
		));
	}
}
