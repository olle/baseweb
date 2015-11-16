<?php
require ('../../private/private.php');
require ('../../baseweb.php');

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-06-17
 */
if ($_POST) {

	$result = Baseweb::getAdmin('staff')->doPost();
	echo json_encode($result);
	
} else {
	
	$action = isset($_GET['action']) ? strval($_GET['action']) : null;
	
	if (!$action || $action == 'help')
		echo Baseweb::getAdmin('staff')->getHelp();
}
?>