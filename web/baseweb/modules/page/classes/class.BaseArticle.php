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
