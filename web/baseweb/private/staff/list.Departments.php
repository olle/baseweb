<?php if ($result->departments->count() > 0): ?>
	<h2><?php echo txt('Departments')?></h2>
	<ul class="departments">
		<?php foreach ($result->departments as $index => $department): ?>
		<?php $status = $department->status ? '' : 'inactive ' ?>
		<?php $selected = ($result->department && $result->department->id == $department->id) ? 'selected' : '' ?>
		<li class="<?php echo $status, $selected ?>" id="department-<?php echo $department->id ?>">
			<img src="/baseweb/private/img/transp.gif" alt="" />
			<form action="" method="post" class="left">
				<fieldset>
					<?php $html->hidden('action', StaffAdmin::ACTION_EDIT) ?>
					<?php $html->hidden('type', StaffAdmin::TYPE_DEPARTMENT) ?>
					<?php $html->hidden('id', $department->id) ?>
				</fieldset>
				<fieldset>
					<?php $html->submit($department->name) ?>
				</fieldset>
			</form>
		</li>
		<?php endforeach ?>
	</ul>
<?php $script =<<<EOT
<script type="text/javascript">
	jQuery('.source-view ul.departments li').click(function(el) {
		jQuery('form', this).get(0).submit();
	});
	jQuery('.source-view ul.departments').sortable({
			handler : '/baseweb/modules/staff/staff-ajax.php?action=sort&type=Department'
	});
</script>
EOT;
$html->addToFooter($script);
?>	
<?php endif ?>
