<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-05-14
 */
require ('../private.php');
require ('../../baseweb.php');

$mainMenu = 'staff';

Baseweb::getModule('html')->addToHeader('<link rel="stylesheet" type="text/css" href="/baseweb/private/css/staff.css" media="all" />');
Baseweb::getModule('html')->addToHeader('<link rel="stylesheet" type="text/css" href="/baseweb/private/css/jquery.filebrowser.css" media="all" />');
Baseweb::getModule('html')->addToHeader('<link rel="stylesheet" type="text/css" href="/baseweb/private/css/jquery.filepicker.css" media="all" />');
Baseweb::getModule('html')->addToHeader('<link rel="stylesheet" type="text/css" href="/baseweb/private/css/jquery.sortable.css" media="all" />');

Baseweb::getModule('html')->addToFooter('<script type="text/javascript" src="/baseweb/private/js/jquery.sortable.js"></script>');

?><?php include('../header.php') ?>
	<div class="source-view">
		<?php require ('list.Employees.php') ?>
		<?php require ('list.Departments.php') ?>		
	</div>
	<div class="content-view high">
		<?php echo $result->help ?>		
		<?php $html->errors($result->errors, 'txt') ?>
		<?php require ('form.Employee.php') ?>		
		<?php require ('form.Department.php') ?>
	</div>
<?php include('../footer.php') ?>