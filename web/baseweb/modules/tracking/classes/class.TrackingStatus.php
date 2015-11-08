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
