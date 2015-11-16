<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-09-22
 */
require ('../private.php');
require ('../../baseweb.php');

$mainMenu = 'page';

Baseweb::getModule('html')->addToHeader('<link rel="stylesheet" type="text/css" href="/baseweb/private/css/page.css" media="all" />');

?><?php include('../header.php') ?>
	<div class="source-view">
		<?php require ('list.Slot.php') ?>
	</div>
	<div class="content-view high">
		<?php require ('form.Slot.php') ?>
	</div>
<?php include('../footer.php') ?>