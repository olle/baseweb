<?php


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
