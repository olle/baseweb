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