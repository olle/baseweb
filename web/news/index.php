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
 * @created 2009-05-22
 */
require ('../baseweb/baseweb.php');
require ('../messages/messages.php');
Baseweb::startCache(__FILE__);
$html = Baseweb::getModule('html');
$mod = Baseweb::getModule('news');
$page = Baseweb::getModule('page');
$galleries = Baseweb::getModule('galleries');
$result = $mod->doGet();
$p = new Baseweb_Params($_GET, array('page' => 1));
?><?php include('../header.php') ?>
	<div id="page">
		<h3><?php echo txt('News') ?> (<?php echo $mod->getNewsCount() ?>)</h3>
		<?php echo $page->slot('intro') ?>
		<?php if ($result->newsitem): ?>
		<div class="newsitem">
			<h3><?php echo $result->newsitem->title ?></h3>
			<p class="body">
				<?php echo $result->newsitem->body ?>
			</p>
			<span class="footer">
				<em><?php echo $result->newsitem->updated_at ?></em>
				<span><?php echo $result->newsitem->author ?></span>
			</span>
		</div>
		<?php endif ?>
		<?php $list = $mod->getNews(array('mixed' => true, 'limit' => 4, 'page' => $p->page)) ?>
		<ul class="news">
			<?php foreach ($list->items as $newsitem): ?>
			<li>
				<a href="/news/<?php echo $newsitem->slug ?>">
					<?php echo $newsitem ?>					
				</a>
			</li>
			<?php endforeach ?>
		</ul>
		<?php $html->pagination($list->pager) ?>
	</div>
<?php
	include('../footer.php');
	Baseweb::endCache(__FILE__);
?>