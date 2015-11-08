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
 * @since 2.x
 * @created 2009-07-03
 */
abstract class BaseVisitor extends Doctrine_Record {

	// PUBLIC METHODS

	public function setUp() {

		parent::setUp();

		$this->hasMany('Track as Tracks', array(
				'local' => 'id',
				'foreign' => 'visitor_id',
		));
	}
	
	public function setTableDefinition() {

		$this->setTableName('tracking_visitor');

		$this->hasColumn('id', 'integer', null, array(
				'primary' => true,
				'autoincrement' => true,
				'notnull' => true,
		));
		
		$this->hasColumn('sid', 'string', 100, array(
				'type' => 'string',
				'fixed' => true,
				'notnull' => true,
				'notblank' => true
		));
		
		$this->hasColumn('ip', 'string', 60, array(
				'type' => 'string',
				'notnull' => true,
				'notblank' => true,
		));
		
		$this->hasColumn('tracked', 'boolean', null, array(
				'notnull' => true,
				'default' => false,
 		));

		$this->hasColumn('archived', 'boolean', null, array(
				'notnull' => true,
				'default' => false,
 		));
	}
}
