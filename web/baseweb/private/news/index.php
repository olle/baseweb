<?php
/*
 * Copyright (c) Olle Törnström studiomediatech.com 2009
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
 * @created 2009-05-14
 */
require ('../private.php');
require ('../../baseweb.php');

$mainMenu = 'news';
Baseweb::getModule('html')->addToHeader('<link rel="stylesheet" type="text/css" href="/baseweb/private/css/news.css" media="all" />');

?><?php include('../header.php') ?>
	<div class="content-list">
		<table class="news">
			<thead>
				<tr>
					<th>&nbsp;</th>
					<th><?php echo txt('Title') ?></th>
					<th><?php echo txt('Created') ?></th>
					<th><?php echo txt('Author') ?></th>
					<th><?php echo txt('Published') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($result->news as $index => $news): ?>
				<?php $row = ($index + 1) % 2 == 0 ? 'even' : 'odd' ?>
				<?php $status = $news->status ? '' : ' inactive' ?>
				<?php $selected = ($result->newsitem && $result->newsitem->id == $news->id) ? ' selected' : '' ?>
				<tr class="<?php echo  $row, $status, $selected ?>">
					<td><img src="/baseweb/private/img/transp.gif" alt="" /></td>
					<td>
						<form action="" method="post">
							<fieldset>
								<input type="hidden" name="action" value="edit" />
								<input type="hidden" name="id" value="<?php echo $news->id ?>" />
							</fieldset>
							<fieldset>
								<?php $html->submit($news->title) ?>
							</fieldset>
						</form>						
					</td>
					<td><?php echo substr($news->created_at, 0, -3) ?></td>
					<td><?php echo $news->author ?></td>
					<td><?php echo ctxt($news->status, 'Published', 'Not published') ?></td>
				</tr>
				<?php endforeach ?>
 			</tbody>
		</table>
<?php
$script =<<<EOT
<script type="text/javascript">
	jQuery('.content-list .news input[type="submit"]').click(function(ev) {
		ev.stopPropagation();
	});
	jQuery('.content-list .news tr').click(function(ev) {
		jQuery('form', this).submit();
	});
	jQuery('.content-list .news tr.selected').each(function(i) {
		var item = jQuery(this);
		var list = jQuery('.content-list');
		var iPos = item.offset();
		var lPos = list.offset();
		var target = Math.max((iPos['top'] - lPos['top']) - list.height() * .3, 0);
		list.scrollTop(target);
	});
</script>
EOT;
$html->addToFooter($script);
?>
	</div>
	<div class="separator"></div>
	<div class="content-view wide">
		<?php echo $result->help ?>		
		<?php $html->errors($result->errors, 'txt') ?>
		<?php require 'form.Newsitem.php' ?>
	</div>
<?php include('../footer.php') ?>