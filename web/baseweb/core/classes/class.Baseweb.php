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
 * @since 2.0
 * @created 2009-06-19
 */
abstract class Baseweb {

	private static $settings;
	private static $connection;
	private static $modules = array();
	private static $admins = array();

	// PUBLIC FUNCTIONS

	public function getSetting($key, $failover = null) {

		if (array_key_exists($key, self::$settings))
			return self::$settings[$key];
		else
			return $failover;
	}

	public static function getSettings() {

		if (is_null(self::$settings))
			self::$settings = new stdClass();

		return self::$settings;
	}

	public static function getConnection() {

		return self::$connection;
	}

	public static function setConnection(&$connection) {

		self::$connection = $connection;
	}

	public static function addModule($name) {

		$class = ucfirst($name);
		self::$modules[$name] = new $class;
	}

	public static function hasModule($name) {

		return array_key_exists($name, self::$modules);
	}

	public static function getModule($name) {

		if (array_key_exists($name, self::$modules))
			return self::$modules[$name];
		else
			return null;
	}

	public static function getModules() {

		return self::$modules;
	}

	public static function addAdmin($name) {

		$class = ucfirst($name) . 'Admin';
		self::$admins[$name] = new $class;
	}

	public static function hasAdmin($name) {

		return array_key_exists($name, self::$admins);
	}

	public static function getAdmin($name) {

		if (array_key_exists($name, self::$admins))
			return self::$admins[$name];
		else
			return null;
	}

	public static function getAdmins() {

		return self::$admins;
	}

	public static function startCache($page) {

		if ($cachedPage = Baseweb_Cache::getCachedPage($page)) {
			include $cachedPage;
			exit;
		} else {
			ob_start();
		}
	}

	public static function endCache($page) {

		Baseweb_Cache::cachePage($page, ob_get_contents());
		ob_end_flush();
	}

}
