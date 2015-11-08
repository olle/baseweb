<?php
/*
 * Copyright (c) Olle Törnström studiomediatech.com 2008-2009
 *
 * THIS CODE IS PROPRIETARY AND PROTECTED BY COPYRIGHT LAW AGAINST COPYING,
 * RE-DISTRIBUTION, PUBLISHING OR DE-COMPILATION WITHOUT THE PRIOR WRITTEN
 * CONSENT OF THE AUTHOR. USAGE IS CONTROLLED BY A LICENSE AGREEMENT,
 * REGULATING THE SPECIFIC, UNIQUE, NON EXCLUSIVE RIGHTS TO RUN, USE OR
 * INCLUDE THE CODE IN WHOLE, PART, COMPILED OR DECOMPILED FORM.
 */
/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-07-01
 */
require ('../baseweb/baseweb.php');
require ('../messages/messages.php');

Baseweb::startCache(__FILE__);

$staff = Baseweb::getModule('staff');
$html = Baseweb::getModule('html');
$galleries = Baseweb::getModule('galleries');

$p = new Baseweb_Params($_GET, array('page' => 1));

if ($staff instanceof Servable) {
	if (!empty($_POST))
		$result = $staff->doPost();
	else
		$result = $staff->doGet();
}

?><?php include('../header.php') ?>
	<div id="page">
		<?php $f = $staff->getDepartment(2) ?>
		<h2><?php echo $f->name ?></h2>
		<ul>
			<?php foreach ($f->members as $member): ?>
			<li>
				<?php echo $member->Employee->name ?>
			</li>
			<?php endforeach ?>
		</ul>
		<?php $e = $staff->getEmployee(4) ?>
		<h3><?php echo $e->name ?></h3>
		<ul>
			<?php foreach ($e->members as $member): ?>
			<li>
				<?php echo $member->Department->name ?>
			</li>
			<?php endforeach ?>
		</ul>
		<?php if ($staff->getDepartments()): ?>
		<h2><?php echo txt('Departments') ?></h2>
		<ul class="departments">
			<?php foreach ($staff->getDepartments() as $department): ?>
			<li>
				<?php echo $department->name ?>
			</li>
			<?php endforeach ?>	
		</ul>
		<?php endif ?>
		<?php $dx = $staff->getDepartments(array('mixed' => true, 'limit' => 3, 'page' => $p->department_page)) ?>
		<ul class="departments">
			<?php foreach ($dx->items as $department): ?>
			<li>
				<?php echo $department->name ?>
			</li>
			<?php endforeach ?>	
		</ul>
		<?php $html->pagination($dx->pager, array('url' => '?&amp;department_page={%page_number}')) ?>
		<?php if ($staff->getEmployees()): ?>
		<h2><?php echo txt('Employees') ?></h2>
		<ul class="employees">
			<?php foreach ($staff->getEmployees() as $employee): ?>
			<li>
				<?php echo $employee->name ?>
				<?php if (!empty($employee->image)): ?>
				<img src="<?php echo $employee->image ?>" alt="<?php echo $employee->name ?>" />
				<?php endif ?>
			</li>
			<?php endforeach ?>
		</ul>
		<?php endif ?>
		<?php $mx = $staff->getEmployees(array('mixed' => true, 'limit' => 3, 'page' => $p->page)) ?>
		<ul class="employees">
			<?php foreach ($mx->items as $employee): ?>
			<li>
				<?php echo $employee->name ?>
			</li>
			<?php endforeach ?>
		</ul>
		<?php $html->pagination($mx->pager) ?>
		<?php if ($staff->getStaff()): ?>
		<h2><?php echo txt('Staff') ?></h2>
		<ul>
			<?php foreach ($staff->getStaff() as $department): ?>
			<li>
				<strong><?php echo $department->name ?></strong>
				<?php if ($department->members->count() > 0): ?>
				<ul>
					<?php foreach ($department->members as $member): ?>
					<li>
						<?php echo $member->Employee->name ?>
					</li>
					<?php endforeach ?>
				</ul>
				<?php endif ?>
			</li>
			<?php endforeach ?>
		</ul>
		<?php endif ?>
	</div>
<?php 
	include('../footer.php');
	Baseweb::endCache(__FILE__);
?>