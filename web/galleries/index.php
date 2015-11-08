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