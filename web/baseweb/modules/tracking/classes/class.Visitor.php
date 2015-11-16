<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.x
 * @created 2009-07-03
 */
class Visitor extends BaseVisitor {

	// PUBLIC METHODS
	
	public function addTrack($params = array()) {
		
		$t = new Track();
		$t->visitor_id = $this->id;
		$t->save();
		
		print_r($_REQUEST);
		
		// TODO: Add visitor track here.. what the visitor does and sees.
	}
}
