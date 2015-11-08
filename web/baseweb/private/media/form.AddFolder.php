<form action="/baseweb/modules/media/media-ajax.php" method="post" id="add-folder">
	<fieldset>
		<?php $html->label(txt('Add folder to current')) ?>					
		<?php $html->hidden('action', MediaAdmin::ACTION_CREATE_FOLDER) ?>
		<?php $html->hidden('currentDir', $dataDir) ?>
	</fieldset>
	<fieldset>
		<?php $html->input('name', '', array('class' => 'small')) ?>
	</fieldset>
	<fieldset class="buttons">
		<?php $html->button(txt('Create folder'), array('img' => '/baseweb/private/img/icons/10.png', 'id' => 'create-folder', 'type' => 'submit')) ?>
	</fieldset>
</form>
<?php
$script =<<<EOT
<script type="text/javascript" src="/baseweb/private/js/jquery.iframer.js"></script>
<script type="text/javascript">
	jQuery('#add-folder').iframer({ 
	    onComplete: function(data) {
	    	jQuery('#add-folder input[name="name"]').attr('value', '');
			jQuery.fn.filebrowser.update(jQuery('li.folder.selected').get(0));
	    }
	});
</script>
EOT;
$html->addToFooter($script);
