<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-05-13
 */
require ('../baseweb/baseweb.php');
require ('../messages/messages.php');
Baseweb::startCache(__FILE__);
$page = Baseweb::getModule('page');
$galleries = Baseweb::getModule('galleries');
$result = $galleries->doGet();
?><?php include('../header.php') ?>
	<div id="page">
		<h3><?php echo $result->gallery->title ?></h3>
		<?php echo $page->slot($result->gallery->slug . '-info') ?>
		<ul>
			<?php foreach ($result->gallery->getThumbnails() as $thumbnail): ?>
			<li>
				<a href="<?php echo $thumbnail->href ?>"><img src="<?php echo $thumbnail->src ?>" /></a>
			</li>
			<?php endforeach ?>
		</ul>
	</div>
<?php 
include('../footer.php');
Baseweb::endCache(__FILE__);
?>