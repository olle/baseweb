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