<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.x
 * @created 2009-07-03
 */
class TrackingStatus extends BaseTrackingStatus {
	
	const ID = '1';
	
	// VARIABLES
	
	private static $instance = null;
	
	// PUBLIC FUNCTIONS
	
	public static function isTracking($visitor = null) {
		
		if (!self::$instance)
			self::_init();
			
		return self::$instance->tracking;
	}
	
	public static function setTracking($isTracking) {
		
		if (!self::$instance)
			self::_init();
			
		self::$instance->tracking = $isTracking;
		self::$instance->save();		
	}
	
	// PRIVATE METHODS
	
	private static function _init() {
	
		$instance = Doctrine::getTable('TrackingStatus')->find(self::ID);

		if (!$instance) {
			$instance = new TrackingStatus();
			$instance->id = self::ID;
			$instance->save();
		}

		self::$instance = $instance;		
	}
}
