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
 * @created 2009-05-13
 */
require ('baseweb/baseweb.php');
require ('messages/messages.php');
Baseweb::startCache(__FILE__);
$news = Baseweb::getModule('news');
$staff = Baseweb::getModule('staff');
$page = Baseweb::getModule('page');
$galleries = Baseweb::getModule('galleries');
?><?php include('header.php') ?>
	<div id="page">
		<?php echo $page->slot('main') ?>
		<div class="news">
			<h3><?php echo txt('News') ?></h3>
			<ul>
			<?php foreach ($news->getNews(array('limit' => 5)) as $newsitem): ?>
				<li>
					<a href="/news/<?php echo $newsitem->slug ?>">
						<?php echo $newsitem->title ?>
					</a>
				</li>
			<?php endforeach ?>
			</ul>
		</div>
		<?php echo $page->slot('sub') ?>
	</div>
<?php
include('footer.php');
Baseweb::endCache(__FILE__);
?>
