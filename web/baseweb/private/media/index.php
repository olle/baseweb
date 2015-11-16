<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.1
 * @created 2009-07-20
 */
require ('../private.php');
require ('../../baseweb.php');

$mainMenu = 'media';

$html = Baseweb::getModule('html');
$baseDir = Baseweb::getSettings()->APP_BASEDIR;
$dataDir = Baseweb::getSettings()->APP_DATADIR;
$dataPath = Baseweb::getSettings()->APP_DATAPATH;

$currentFile = null;

$html->addToHeader('<link rel="stylesheet" href="/baseweb/private/css/jquery.filebrowser.css" />');

?><?php include('../header.php') ?>
	<div class="source-view">
	</div>
<?php
$script =<<<EOT
<script type="text/javascript" src="/baseweb/private/js/jquery.filebrowser.js"></script>
<script type="text/javascript">
	var dataDir = Baseweb.APP_DATADIR;
	var basePath = Baseweb.APP_BASEDIR + Baseweb.APP_DATAPATH;
	jQuery('.source-view').filebrowser({
		'dir' : Baseweb.APP_DATADIR,
		'handler' : '/baseweb/modules/media/media-browse.php'
	},function (el) {
		var jel = jQuery(el);
		if (jel.hasClass('folder')) {
			setCurrentDir(jel.attr('rel'));
			if (jel.hasClass('empty'))
				jQuery('#delete-folder').show();		
			else
				jQuery('#delete-folder').hide();
			jQuery('.folder-edit').show();
			jQuery('.file-edit').hide();		
		} else {
			setCurrentFile(jel.attr('rel'));
			jQuery('.file-edit').show();
			jQuery('.folder-edit').hide();
		}
	});
	setCurrentDir = function (folder) {
		var dir = folder || Baseweb.APP_DATADIR;
		jQuery('#current-dir').empty().text(dir.replace(basePath, ''));
		jQuery('input[name="currentDir"]').each(function() {
			jQuery(this).val(dir);
		});
	};
	setCurrentFile = function (filepath) {
		var file = filepath || '';
		jQuery('#current-file').empty().text(file !== '' ? file.replace(basePath, '') : txt('None')); 
		jQuery('input[name="currentFile"]').each(function() {
			jQuery(this).val(file);
		});
		jQuery('input[name="targetFile"]').each(function() {
			jQuery(this).val(file.replace(basePath, ''));
		});
	};
</script>
EOT;
$html->addToFooter($script);
?>	
	<div class="content-view high">
		<div class="form-wrapper clearfix">
			<?php if ($result->error): ?>
			<?php $html->actionError($result->error) ?>
			<?php endif ?>
			<div class="folder-edit" style="display: block;">
				<h3><?php echo txt('Directory editor') ?></h3>
				<form action="" method="post">
					<fieldset>
						<?php $html->label(txt('Current directory')) ?>
						<p id="current-dir" class="readonly">/</p>						
					</fieldset>
				</form>			
				<?php require 'form.AddFolder.php' ?>	
				<?php require 'form.DeleteFolder.php' ?>
				<?php require 'form.AddFile.php' ?>
			</div>
			<div class="file-edit" style="display: none;">
				<h3><?php echo txt('File editor') ?></h3>
				<form action="" method="post">
					<fieldset>
						<?php $html->label(txt('Current file')) ?>
						<p id="current-file" class="readonly"><?php echo $currentFile ? $currentFile : txt('None') ?></p>
					</fieldset>
				</form>
				<?php require 'form.DeleteFile.php' ?>
			</div>
		</div>
	</div>
<?php include('../footer.php') ?>