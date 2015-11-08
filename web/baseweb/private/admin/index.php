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
	<div class="content-view full">
		<?php echo $result->help ?>
		<?php if ($install): ?>
		<div class="admin">
			<h1>Baseweb Admin</h1>
			<dl class="installations">
				<?php foreach ($install->getInstallations() as $installee): ?>
				<dt><?php echo txt($installee->key) ?></dt>
				<dd><?php echo $installee->value ?></dd>
				<?php endforeach ?>
			</dl>
		</div>
		<?php endif ?>
	</div>
<?php include('../footer.php') ?>