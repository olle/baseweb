<?php
/*
 * Copyright (c) Olle Törnström studiomediatech.com 2009
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
 * @created 2009-09-15
 */
abstract class Baseweb_Cache {

	public static function getCachedPage($page) {
		
		$cacheFile = self::_getCacheFileName($page);
		$cacheTime = Baseweb::getSettings()->CACHE_TIME;
		
		if (file_exists($cacheFile) && time() - $cacheTime < filemtime($cacheFile))
			return $cacheFile;
			
		return null;
	}
	
	public static function cachePage($page, $contents) {
		
		$cacheFile = self::_getCacheFileName($page);
		
		try {
			$file = @fopen($cacheFile, 'w') or die('Unable to cache the page<br />' . $cacheFile . '<br />Please make sure the cache folder exists and is writable by the server.');
			fwrite($file, $contents);
			fclose($file);
		} catch (Exception $e) {}
	}
	
	private static function _getCacheFileName($page) {
		
		return realpath(Baseweb::getSettings()->CACHE_DIR) . '/' . md5($page . $_SERVER['QUERY_STRING']) . '.html';
	}
}	