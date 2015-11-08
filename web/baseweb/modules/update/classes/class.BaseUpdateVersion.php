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
