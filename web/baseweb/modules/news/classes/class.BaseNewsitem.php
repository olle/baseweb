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
 * @since 2.0
 * @created 2009-06-19
 */
abstract class BaseNewsitem extends Doctrine_Record {

	// PUBLIC METHODS

	public function setUp() {
		
		$this->actAs('Timestampable');
		
        $this->actAs('Sluggable', array(
                'unique'    => true,
                'fields'    => array('title', 'created_at'),
                'canUpdate' => true
            )
        );		
	}
	
	public function setTableDefinition() {

		$this->setTableName('news_newsitem');

		$this->hasColumn('id', 'integer', 4, array(
				'type' => 'integer',
				'length' => 4,
				'unsigned' => 1,
				'primary' => true,
				'autoincrement' => true,
				));
		
		$this->hasColumn('title', 'string', 100, array(
				'type' => 'string',
				'length' => 100,
				'fixed' => false,
				'primary' => false,
				'default' => '',
				'notnull' => true,
				'notblank' => true,
				'autoincrement' => false,
				));
				
		$this->hasColumn('status', 'integer', 1, array(
				'type' => 'integer',
				'length' => 1,
				'unsigned' => 1,
				'primary' => false,
				'default' => '1',
				'notnull' => true,
				'autoincrement' => false,
				));
				
		$this->hasColumn('author', 'string', 20, array(
				'type' => 'string',
				'length' => 20,
				'fixed' => false,
				'primary' => false,
				'default' => '',
				'notnull' => true,
				'notblank' => true,
				'autoincrement' => false,
				));
				
		$this->hasColumn('ip', 'string', 16, array(
				'type' => 'string',
				'length' => 16,
				'fixed' => false,
				'primary' => false,
				'default' => '',
				'notnull' => true,
				'autoincrement' => false,
				));
				
		$this->hasColumn('body', 'string', null, array(
				'type' => 'string',
				'fixed' => false,
				'primary' => false,
				'default' => '',
				'notnull' => true,
				'notblank' => true,
				'autoincrement' => false,
				));
	}
}
