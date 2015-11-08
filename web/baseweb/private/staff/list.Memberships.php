<?php if ($result->employee || $result->department): ?>
<div class="sub-list clearfix">
	<h3><?php echo ctxt($result->employee, 'This person is shown in the following departments, with title', 'This department has the following employee, with title')?></h3>
	<ul class="<?php echo $result->employee ? 'departments' : 'employees' ?> clearfix" id="membership-list">
		<?php $collection = $result->employee ? $result->employee->members : $result->department->members ?>
		<?php foreach ($collection as $member): ?>
		<?php $employeeId = $result->employee ? $result->employee->id : $member->Employee->id; ?>
		<?php $departmentId = $result->employee ? $member->Department->id : $result->department->id; ?>
		<li class="<?php echo ($result->employee ? $member->Department->status : $member->Employee->status) ? '' : 'inactive' ?>" id="staffmember-<?php echo $employeeId, '-', $departmentId ?>">
			<img src="/baseweb/private/img/transp.gif" alt="" />
			<form action="" method="post" class="inline">				
				<p>
					<?php echo $result->employee ? $member->Department->name : $member->Employee->name ?>,
				</p>
				<fieldset>
					<?php $html->hidden('action', StaffAdmin::ACTION_RENAME_MEMBERSHIP) ?>
					<?php $html->hidden('type', $result->employee ? StaffAdmin::TYPE_EMPLOYEE : StaffAdmin::TYPE_DEPARTMENT) ?>
					<?php $html->hidden('employee_id', $employeeId) ?>
					<?php $html->hidden('department_id', $departmentId) ?>
				</fieldset>
				<fieldset>
					<?php $html->input('title', $member->title ? $member->title : ($result->employee ? $result->employee->title : $member->Employee->title)) ?>
				</fieldset>
				<fieldset class="buttons">
					<?php $html->button(txt('Save'), array('class' => 'rect')) ?>
				</fieldset>
			</form>
			<form action="" method="post" class="right">
				<fieldset>
					<?php $html->hidden('action', StaffAdmin::ACTION_REMOVE_MEMBERSHIP) ?>
					<?php $html->hidden('type', $result->employee ? StaffAdmin::TYPE_EMPLOYEE : StaffAdmin::TYPE_DEPARTMENT) ?>
					<?php $html->hidden('employee_id', $result->employee ? $result->employee->id : $member->Employee->id) ?>
					<?php $html->hidden('department_id', $result->employee ? $member->Department->id : $result->department->id) ?>
				</fieldset>
				<fieldset class="buttons">
					<?php $html->button(txt('Remove'), array('class' => 'rect passive')) ?>						
				</fieldset>
			</form>
		</li>
		<?php endforeach ?>
	</ul>
<?php
if ($result->department) { 
	$script =<<<EOT
<script type="text/javascript">
	jQuery('ul#membership-list').sortable({
			handler : '/baseweb/modules/staff/staff-ajax.php?action=sort&type=StaffMember'
	});
</script>
EOT;
	$html->addToFooter($script);
}
?>	
	<?php require ('form.Membership.php') ?>
</div>
<?php endif ?>