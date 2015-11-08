<?php $html->button(ctxt($result->department, 'Add an employee to the group', 'Add a department'), array('class' => 'add-membership rect large', 'img' => '/baseweb/private/img/icons/83.png')) ?>
<form action="" method="post" class="add-membership"">
	<fieldset>
		<?php $html->hidden('action', StaffAdmin::ACTION_ADD_MEMBERSHIP) ?>
		<?php $html->hidden('id', $result->department ? $result->department->id : $result->employee->id) ?>
		<?php $html->hidden('type', $result->department ? StaffAdmin::TYPE_DEPARTMENT : StaffAdmin::TYPE_EMPLOYEE) ?>
	</fieldset>
	<fieldset>		
		<?php $html->input('name', ctxt($result->department, 'Enter the name of an employee', 'Enter the name of a department')) ?>
	</fieldset>
	<fieldset class="buttons">
		<?php $html->button(txt('Add'), array('class' => 'rect large')) ?>
		<?php $html->button(txt('Cancel'), array('class' => 'rect large', 'type' => 'reset')) ?>
	</fieldset>
</form>
<?php
$script =<<<EOT
<script type="text/javascript">
	var defaultInputText = jQuery('form.add-membership input[type="text"]').val();
	jQuery('form.add-membership').hide();
	jQuery('form.add-membership button[type="reset"]').click(function() {
		jQuery('form.add-membership').hide();
		jQuery('button.add-membership').show();
	});
	jQuery('button.add-membership').click(function() {
		jQuery(this).hide();
		jQuery('form.add-membership').show();
		jQuery('form.add-membership input[type="text"]');
	});
	jQuery('form.add-membership input[type="text"]').focus(function() {
		if ($(this).val() === defaultInputText)
			$(this).val('');
	}).blur(function() {
		if ($(this).val() === '')
			$(this).val(defaultInputText);
	});
</script>
EOT;
$html->addToFooter($script);
?>
