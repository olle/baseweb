<?php

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