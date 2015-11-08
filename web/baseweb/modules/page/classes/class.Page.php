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
class Page extends Baseweb_Module {

	const MODULE_NAME = 'page';

	// VARIABLES

	protected $name = Page::MODULE_NAME;
	
	// PUBLIC METHODS
	
	public function slot($name) {
		
		$address = $_SERVER['PHP_SELF'];
		
		$slot = $this->storage->getSlot($address, $name);
		
		if (!$slot)
			$slot = $this->storage->addSlot($address, $name);
			
		return $slot->getContent();
	}
}
