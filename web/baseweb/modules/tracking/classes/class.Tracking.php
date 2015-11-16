<?php

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