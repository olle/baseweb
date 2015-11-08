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
 * @since 2.1
 * @created 2009-09-25
 */
require ('../private.php');
require ('../../baseweb.php');
$mainMenu = 'update';
Baseweb::getModule('html')->addToHeader('<link rel="stylesheet" type="text/css" href="/baseweb/private/css/update.css" media="all" />');
?><?php include('../header.php') ?>
	<div class="content-view full">
		<?php echo $result->help ?>
		<div class="update">
			<?php if ($result->isUpToDate): ?>
			<h3><?php echo txt('Congratulations') ?>!</h3>
			<p><?php echo dtxt('Your version of Baseweb is up to date with version %s', $result->installInfo->version) ?></p>
			<?php else: ?>
			<form action="" method="post">
				<p><?php echo dtxt('Update baseweb from version %s to %s on %s', $result->installInfo->version, Baseweb::getSettings()->APP_VERSION,  Baseweb::getSettings()->WEB_HOST)?></p>
				<fieldset class="buttons">
					<?php $html->hidden('action', 'update') ?>
					<?php $html->button(txt('Update'), array('img' => '/baseweb/private/img/icons/10.png', 'class' => 'update-action', 'style' => 'display: none;')) ?>
<?php 
$title = txt('Update baseweb?');
$text = txt('Are you sure you want to update Baseweb?');
$ok = txt('Ok');
$cancel = txt('Cancel');
$script =<<<EOT
<script type="text/javascript">
	jQuery('.update-action').show().Confirm(function(confirmed, el) {
		if (confirmed) {
			jQuery(el).parent().parent().submit();
		}
	}, {
		'title' : '$title',
		'text' : '$text',
		'ok' : '$ok',
		'cancel' : '$cancel'
	});
</script>
EOT;
$html->addToFooter($script);
?>						
				</fieldset>
			</form>	
			<?php endif ?>		
		</div>
	</div>
<?php include('../footer.php') ?>