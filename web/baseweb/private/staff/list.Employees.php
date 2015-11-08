<?php if ($result->employees->count() > 0): ?>
	<h2><?php echo txt('Employees')?></h2>
	<ul class="employees">
		<?php foreach ($result->employees as $index => $employee): ?>
		<?php $status = $employee->status ? '' : 'inactive ' ?>
		<?php $selected = ($result->employee && $result->employee->id == $employee->id) ? 'selected' : '' ?>
		<li class="<?php echo $status, $selected ?>" id="employee-<?php echo $employee->id ?>">
			<img src="/baseweb/private/img/transp.gif" alt="" />
			<form action="" method="post" class="left">
				<fieldset>
					<?php $html->hidden('action', StaffAdmin::ACTION_EDIT) ?>
					<?php $html->hidden('type', StaffAdmin::TYPE_EMPLOYEE) ?>
					<?php $html->hidden('id', $employee->id) ?>
				</fieldset>
				<fieldset>
					<?php $html->submit($employee->name) ?>
				</fieldset>
			</form>
		</li>
		<?php endforeach ?>
	</ul>
<?php $script =<<<EOT
<script type="text/javascript">
	jQuery('.source-view .employees li').click(function(el) {
		jQuery('form', this).get(0).submit();
	});
	jQuery('.source-view ul.employees').sortable({
			handler : '/baseweb/modules/staff/staff-ajax.php?action=sort&type=Employee'
	});
</script>
EOT;
$html->addToFooter($script);
?>		
<?php endif ?>
