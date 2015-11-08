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
class Tracking extends Baseweb_Module {
	
	const MODULE_NAME = 'tracking';
	
	// VARIABLES
	
	protected $name = self::MODULE_NAME;
	
	// PUBLIC METHODS

	public function track($params = array()) {

		if (!TrackingStatus::isTracking())
			return;

		$visitor = $this->storage->getVisitor(session_id());
		
		if (!$visitor)
			$visitor = $this->storage->newVisitor(session_id(), $_SERVER['REMOTE_ADDR']);
		
		if (!$visitor->tracked)
			return;
			
		$visitor->addTrack($params);
	}
	
}