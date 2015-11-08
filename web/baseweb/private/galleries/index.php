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
 * @since 2.0
 * @created 2010-12-25
 */
require ('../private.php');
require ('../../baseweb.php');

$mainMenu = 'galleries';

Baseweb::getModule('html')->addToHeader('<link rel="stylesheet" type="text/css" href="/baseweb/private/css/galleries.css" media="all" />');

?><?php include('../header.php') ?>
	<div class="source-view">
		<?php require ('list.Galleries.php') ?>
	</div>
	<div class="content-view high">
    <?php echo $result->help ?>   
    <?php $html->errors($result->errors, 'txt') ?>
		<?php require ('form.Gallery.php') ?>
	</div>
<?php include('../footer.php') ?>