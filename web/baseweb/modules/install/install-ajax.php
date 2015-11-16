<?php
require ('../../private/private.php');
require ('../../baseweb.php');

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-06-17
 */
if ($_POST) {

	// TODO: Handle Ajax-post here.
	
} else {
	
	$action = isset($_GET['action']) ? strval($_GET['action']) : null;
	
	if (!$action || $action == 'help')
		echo Baseweb::getAdmin('install')->getHelp();
}
?>