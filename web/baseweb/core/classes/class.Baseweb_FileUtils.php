<?php
/*
 * Copyright (c) Olle Törnström studiomediatech.com 2010
 *
 * THIS CODE IS PROPRIETARY AND PROTECTED BY COPYRIGHT LAW AGAINST COPYING,
 * RE-DISTRIBUTION, PUBLISHING OR DE-COMPILATION WITHOUT THE PRIOR WRITTEN
 * CONSENT OF THE AUTHOR. USAGE IS CONTROLLED BY A LICENSE AGREEMENT,
 * REGULATING THE SPECIFIC, UNIQUE, NON EXCLUSIVE RIGHTS TO RUN, USE OR
 * INCLUDE THE CODE IN WHOLE, PART, COMPILED OR DECOMPILED FORM.
 */
/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.1
 * @created 2010-12-26
 */
abstract class Baseweb_FileUtils {
	
	// PUBLIC FUNCTIONS
	
	/**
	 * @param object $dir absolute path to directory to list files from
	 * @param object $filter [optional] anonymous, or function name, to applied as
	 *               filter for each item found in the directory. Empty filter by
	 *               default.
	 * @return an array of found filenames
	 */
	public static function listFiles($dir, Baseweb_FileFilter $filter = null) {
		if ($filter == null) {
			$filter = new Baseweb_FileFilter();
		}
    $result = array();
		if (file_exists($dir)) {
			if ($scanResult = scandir($dir)) {
				$dirItems = $filter->filter($scanResult);  
				natcasesort($dirItems);
			  foreach ($dirItems as $item) {
			    if (self::isCleanFile($dir, $item)) {
			      $result[] = $item;
			    }
			  }				
			}
		}
		return $result;		
	}
	
	protected static function isCleanDir($dir, $fileItem) {
	  return file_exists($dir . $fileItem) && is_dir($dir . $fileItem);
	}
	
	protected static function isCleanFile($dir, $fileItem) {
	  return file_exists($dir . $fileItem) && !is_dir($dir . $fileItem);
	}	
}
