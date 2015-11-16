<?php
require ('../../private/private.php');
require ('../../baseweb.php');

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.2
 * @created 2009-09-22
 */
if ($_POST) {

	// TODO: Handle Ajax-post here.
	
} else {
	
	$action = isset($_GET['action']) ? strval($_GET['action']) : null;
	
	if (!$action || $action == 'help')
		echo Baseweb::getAdmin('page')->getHelp();
	
}
