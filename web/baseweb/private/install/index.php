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
 * @created 2009-05-13
 */
require ('../private.php');
require ('../../baseweb.php');

$mainMenu = 'install';

Baseweb::getModule('html')->addToHeader('<link rel="stylesheet" type="text/css" href="/baseweb/private/css/install.css" media="all" />');

?><?php include('../header.php') ?>

	<div class="content-view full">

		<?php echo $result->help ?>
		
		<div class="install">
			<form action="." method="post">
				<fieldset>
					<p>
						<?php echo dtxt('Install baseweb %s on %s', Baseweb::getSettings()->APP_VERSION, Baseweb::getSettings()->WEB_HOST)?>
					</p>
					<input type="hidden" name="action" value="install" />
				</fieldset>
				<fieldset>
					<label><?php echo txt('Include test data')?></label>
					<input type="checkbox" name="testdata" value="yes" />
				</fieldset>
				<fieldset class="buttons">
					<?php $html->button(txt('Install'), array('img' => '/baseweb/private/img/icons/10.png', 'class' => 'install-action', 'style' => 'display: none;')) ?>
<?php 
$title = txt('Install baseweb?');
$text = txt('Are you sure you want to install baseweb. This will overwrite any previous installation, removing all information.');
$ok = txt('Ok');
$cancel = txt('Cancel');
$script =<<<EOT
<script type="text/javascript">
	jQuery('.install-action').show().Confirm(function(confirmed, el) {
		if (confirmed) {
			var form = jQuery(el).parent().parent().submit();
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
		</div>
	</div>
	
<?php include('../footer.php') ?>