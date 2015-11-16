<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-05-14
 */
$modules = parse_ini_file('output/baseweb/modules/modules.ini', true);
$active = array_keys($modules['modules']);
$dir = dirname(__FILE__) . '/output/baseweb/modules/';
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
        	if ($file == '.' || $file == '..')
				continue;
				
        	if (is_dir($dir . $file) && !in_array($file, $active)) {
        		print "$dir$file\n";
			}
        }
        closedir($dh);
    }
}

exit;