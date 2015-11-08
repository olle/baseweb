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
 * @created 2009-05-14
 */
function modules() {

	$modules = parse_ini_file('modules.ini', true);
	
	foreach ($modules['modules'] as $module => $status) {

		if (!$status)
			continue;

		$mainPath = dirname( __FILE__ ) . '/../modules/' . $module . '/' . $module . '.php';
		$adminPath = dirname( __FILE__ ) . '/../modules/' . $module . '/' . $module . '-admin.php';

		if (file_exists($mainPath)) {			
			require($mainPath);
			Baseweb::addModule($module);
		}
		
		if (defined('BASEWEB_ADMIN_ENABLED') && file_exists($adminPath)) {
			require($adminPath);
			Baseweb::addAdmin($module);
		}
	}
}

modules();
