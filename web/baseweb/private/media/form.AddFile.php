<form action="/baseweb/modules/media/media-ajax.php" method="post" enctype="multipart/form-data" id="file-upload">
	<fieldset>
		<?php $html->label(txt('Upload file to current folder')) ?>	
		<?php $html->hidden('action', MediaAdmin::ACTION_UPLOAD_FILE) ?>
		<?php $html->hidden('currentDir', $dataDir) ?>
		<?php $html->file('files', array('id' => 'browse-files')) ?>
	</fieldset>
	<fieldset class="buttons">
		<?php $html->button(txt('Upload'), array('img' => '/baseweb/private/img/icons/10.png', 'id' => 'upload-files', 'type' => 'submit')) ?>
	</fieldset>
</form>
<?php
$script =<<<EOT
<script type="text/javascript" src="/baseweb/private/js/jquery.iframer.js"></script>
<script type="text/javascript">
	jQuery('#file-upload').iframer({ 
	    onComplete: function(data) {
	    	jQuery('#browse-files').before('<input type="file" name="files" id="browse-files" />').remove();
			jQuery.fn.filebrowser.update(jQuery('li.folder.selected').get(0));
	    }
	});
</script>
EOT;
$html->addToFooter($script);