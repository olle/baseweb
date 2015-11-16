<?php
require ('../../private/private.php');
require ('../../baseweb.php');

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-09-16
 */
if ($_POST) {

	$result = Baseweb::getAdmin('media')->doPost();
	echo json_encode($result);
	
} else {
	
	$action = isset($_GET['action']) ? strval($_GET['action']) : null;
	
	if (empty($action) || $action == 'help')
		echo Baseweb::getAdmin('media')->getHelp();
	
}
?>