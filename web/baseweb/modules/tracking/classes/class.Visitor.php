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
