<?php if ($result->department): ?>
<div class="department clearfix">
	<form action="" method="post">
		<fieldset>
			<?php $html->hidden('action', StaffAdmin::ACTION_SAVE) ?>
			<?php $html->hidden('type', StaffAdmin::TYPE_DEPARTMENT) ?>
			<?php $html->hidden('id', $result->department->id) ?>
		</fieldset>
		<fieldset>
			<?php $html->label('name', txt('Name'), $result->errors) ?>
			<?php $html->input('name', $result->department->name) ?>
		</fieldset>
		<fieldset>
			<?php $html->hidden('status', 0) ?>
			<?php $html->checkbox('status', 1, $result->department->status) ?>
			<?php $html->label('status', txt('Show on web')) ?>
		</fieldset>
		<fieldset class="buttons">
			<?php $html->button(ctxt($result->department->id, 'Save changes', 'Save'), array('img' => '/baseweb/private/img/icons/10.png')) ?>
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
							'disabled' => $result->department->id ? '' : 'disabled'
				)) ?>
<?php 
$title = txt('Delete department?');
$text = txt('Really delete the department? This action cannot be undone.');
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
</div>
<?php require ('list.Memberships.php') ?>
<?php endif ?>