<?php
/*
 * Copyright (c) Olle Törnström studiomediatech.com 2008-2009
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
 * @created 2009-06-17
 */
require ('../private.php');
require ('../../baseweb.php');

$mainMenu = 'admin';

$html = Baseweb::getModule('html');
$html->addToHeader('<link rel="stylesheet" type="text/css" href="/baseweb/private/css/admin.css" media="all" />');
$install = Baseweb::getAdmin('install');

?><?php include('../header.php') ?>
	<div class="content-view high wide">
		<div class="admin">
			<div class="clearfix">
				<h3>Buttons</h3>
				<?php $html->button('default') ?>
				<?php $html->button('with image', array('img' => '/baseweb/private/img/icons/10.png')) ?>
				<?php $html->button('rect', array('class' => 'rect')) ?>
				<?php $html->button('small', array('class' => 'small')) ?>
				<?php $html->button('primary', array('class' => 'primary')) ?>				
				<?php $html->button('dark', array('class' => 'dark')) ?>				
				<?php $html->button('with image', array('img' => '/baseweb/private/img/icons/10.png', 'class' => 'dark')) ?>
				<?php $html->button('mini', array('class' => 'mini')) ?>				
			</div>
		</div>
	</div>
<?php include('../footer.php') ?>