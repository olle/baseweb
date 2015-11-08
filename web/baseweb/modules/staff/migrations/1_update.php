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
class Update extends Doctrine_Migration_Base {

	public function up() {
		$this->addColumn('employee', 'image', 'string', array(
				'notnull' => true,
				'default' => '',
		));
		$this->addColumn('employee', 'position', 'integer');
	}
	
	public function postUp() {
		$q = new Doctrine_Query();
		$q->update('Employee');
		$q->set('position', 'id');
		$q->execute();
	}
	
	public function down() {
		$this->removeColumn('employee', 'image');
		$this->removeColumn('employee', 'position');
	}
}