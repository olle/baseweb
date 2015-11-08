<?php if ($result->employee): ?>
<div class="employee clearfix">
	<form action="" method="post">
		<fieldset>
			<?php $html->hidden('action', 'save') ?>
			<?php $html->hidden('type', StaffAdmin::TYPE_EMPLOYEE) ?>
			<?php $html->hidden('id', $result->employee->id) ?>		
		</fieldset>
		<fieldset>
			<?php $html->label('name', txt('Name'), $result->errors) ?>
			<?php $html->input('name', $result->employee->name) ?>
		</fieldset>
		<fieldset>
			<?php $html->label('image', txt('Image'), $result->errors) ?>
			<?php $html->input('image', $result->employee->image) ?>
<?php if (Baseweb::hasAdmin('media')): ?>
<?php $script =<<<EOT
<script type="text/javascript" src="/baseweb/private/js/jquery.filebrowser.js"></script>
<script type="text/javascript" src="/baseweb/private/js/jquery.filepicker.js"></script>
<script type="text/javascript">
	jQuery('input[name="image"]').filepicker(function (pick) {
		jQuery('input[name="image"]').attr('value', pick.indexOf('http') > -1 ? pick : pick.replace(Baseweb.APP_BASEDIR, ''));
	}, {
			'dir' : Baseweb.APP_DATADIR,
			'handler' : '/baseweb/modules/media/media-browse.php'		
	});
</script>
EOT;
$html->addToFooter($script);
?>
<?php endif ?>
		</fieldset>
		<fieldset>
			<?php $html->label('slug', txt('Safe name, slug')) ?>
			<span class="readonly"><?php echo $result->employee->slug ?></span>
		</fieldset>				
		<fieldset>
			<?php $html->label('title', txt('Title'), $result->errors) ?>
			<?php $html->input('title', $result->employee->title) ?>
		</fieldset>
		<fieldset>
			<?php $html->label('email', txt('E-mail'), $result->errors) ?>
			<?php $html->input('email', $result->employee->email) ?>
		</fieldset>
		<fieldset>
			<?php $html->label('phone', txt('Phone'), $result->errors) ?>
			<?php $html->input('phone', $result->employee->phone) ?>
		</fieldset>
		<fieldset>
			<?php $html->label('mobile', txt('Mobile'), $result->errors) ?>
			<?php $html->input('mobile', $result->employee->mobile) ?>
		</fieldset>
		<fieldset>
			<?php $html->hidden('status', 0) ?>
			<?php $html->checkbox('status', 1, $result->employee->status) ?>
			<?php $html->label('status', txt('Show on web')) ?>
		</fieldset>
		<fieldset class="buttons">
			<?php $html->button(ctxt($result->employee->id != 0, 'Save changes', 'Save'), array('img' => '/baseweb/private/img/icons/10.png')) ?>
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
			<?php if ($result->employee->id): ?>
				<?php $html->button(txt('Delete'), array('img' => '/baseweb/private/img/icons/86.png', 'class' => 'delete-action', 'style' => 'display: none;')) ?>
<?php 
$script =<<<EOT
<script type="text/javascript">
	jQuery('.delete-action').show().Confirm(function(confirmed, el) {
		if (confirmed) {
			var form = jQuery(el).parent().parent();
			form.find('input[name="action"]').attr('value', 'delete');
			form.submit();				
		}
	}, {
		'title' : txt('Delete employee?'),
		'text' : txt('Really delete the employee? This action cannot be undone.'),
		'ok' : txt('Ok'),
		'cancel' : txt('Cancel')
	});
</script>
EOT;
$html->addToFooter($script);
?>				
			<?php endif ?>
		</fieldset>
	</form>
</div>
<?php require ('list.Memberships.php') ?>
<?php endif ?>