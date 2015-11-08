<form action="/baseweb/modules/media/media-ajax.php" method="post" id="delete-folder" style="display: none;">
	<fieldset>
		<?php $html->hidden('action', MediaAdmin::ACTION_DELETE_FOLDER) ?>
		<?php $html->hidden('currentDir', $dataDir) ?>
	</fieldset>
	<fieldset class="buttons">						
		<?php $html->button(txt('Delete folder'), array('img' => '/baseweb/private/img/icons/10.png', 'type' => 'submit')) ?>
	</fieldset>
</form>
<?php
$script =<<<EOT
<script type="text/javascript" src="/baseweb/private/js/jquery.iframer.js"></script>
<script type="text/javascript">
	jQuery('#delete-folder').iframer({
	    onComplete: function(data) {
			var parent = jQuery('li.folder.selected').removeClass('selected').parent().closest('li.folder.open').addClass('selected');
			if (parent.length) {
				setCurrentDir(parent.attr('rel'));
				jQuery.fn.filebrowser.update(parent.get(0));
			} else {
				setCurrentDir();
				jQuery.fn.filebrowser.update();
				jQuery('#delete-folder').hide();
			}
	    }
	});
</script>
EOT;
$html->addToFooter($script);