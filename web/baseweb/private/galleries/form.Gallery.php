<?php if ($result->gallery): ?>
<div class="gallery clearfix">
	<form action="" method="post">
		<fieldset>
			<?php $html->hidden('action', GalleriesAdmin::ACTION_SAVE) ?>
			<?php $html->hidden('id', $result->gallery->id) ?>
		</fieldset>
		<fieldset>
			<?php $html->label('title', txt('Title'), $result->errors) ?>
			<?php $html->input('title', $result->gallery->title) ?>
		</fieldset>
    <fieldset>
      <?php $html->label('slug', txt('Safe name, slug')) ?>
      <span class="readonly"><?php echo $result->gallery->slug ? $result->gallery->slug : '&nbsp;' ?></span>
    </fieldset>		
		<fieldset>
			<?php $html->label('path', txt('Content path'), $result->errors) ?>
			<?php $html->legend(txt('Relative to the global user configured content path')) ?>
			<?php $html->input('path', $result->gallery->path) ?>
		</fieldset>
		<fieldset>
			<?php $html->hidden('status', 0) ?>
			<?php $html->checkbox('status', 1, $result->gallery->status) ?>
			<?php $html->label('status', txt('Show on web')) ?>
		</fieldset>
		<fieldset class="buttons">
			<?php $html->button(ctxt($result->gallery->id, 'Save changes', 'Save'), array('img' => '/baseweb/private/img/icons/10.png')) ?>
			<?php $html->button(txt('Cancel'), array('img' => '/baseweb/private/img/icons/2.png', 'class' => 'close-action', 'style' => 'display: none;')) ?>
<?php $script =<<<EOT
<script type="text/javascript">
	jQuery('.close-action').css({'display' : 'block'}).click(function(ev) {
		ev.preventDefault();
		var form = jQuery(this).parent().parent();
		form.find('input[name="action"]').attr('value', 'close');
		form.submit();
	});
</script>
EOT;
$html->addToFooter($script);
?>				
				<?php $html->button(txt('Delete'), array(
							'img' => '/baseweb/private/img/icons/86.png', 
							'class' => 'delete-action', 
							'style' => 'display: none;',
							'disabled' => $result->gallery->id ? '' : 'disabled'
				)) ?>
<?php 
$title = txt('Delete gallery?');
$text = txt('Really delete the gallery? This action cannot be undone.');
$ok = txt('Ok');
$cancel = txt('Cancel');
$script =<<<EOT
<script type="text/javascript">
	jQuery('.delete-action').show().Confirm(function(confirmed, el) {
		if (confirmed) {
			var form = jQuery(el).parent().parent();
			form.find('input[name="action"]').attr('value', 'delete');
			form.submit();				
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
	<?php require ('list.Images.php') ?>
</div>
<?php endif ?>