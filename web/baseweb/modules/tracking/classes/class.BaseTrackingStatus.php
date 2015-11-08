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
