<form action="/baseweb/modules/media/media-ajax.php" method="post" id="delete-file">
	<fieldset>
		<?php $html->hidden('action', MediaAdmin::ACTION_DELETE_FILE) ?>
		<?php $html->hidden('currentFile', $currentFile) ?>					
	</fieldset>
	<fieldset class="buttons">
		<?php $html->button(txt('Delete'), array('img' => '/baseweb/private/img/icons/10.png', 'type' => 'submit')) ?>
	</fieldset>
</form>
<?php
$script =<<<EOT
<script type="text/javascript" src="/baseweb/private/js/jquery.iframer.js"></script>
<script type="text/javascript">
	jQuery('#delete-file').iframer({ 
	    onComplete: function(data) {
	    	setCurrentFile();
			var parent = jQuery('li.file.selected').parent().closest('li.folder.open').addClass('selected');
			jQuery.fn.filebrowser.update(parent.get(0));
	    }
	});
</script>
EOT;
$html->addToFooter($script);