<?php

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
