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
