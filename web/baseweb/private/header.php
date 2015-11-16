	<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-04-01
 */

// $mainMenu is set in the including php-page
$admin = Baseweb::getAdmin($mainMenu);
$html = Baseweb::getModule('html');

if ($admin instanceof Servable && !empty($_POST))
	$result = $admin->doPost();	
else if ($admin instanceof Servable)
	$result = $admin->doGet();

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta http-equiv="pragma" content="no-cache" />
		<meta http-equiv="expires" content="-1" />
        <title>baseweb admin</title>
		<link rel="stylesheet" type="text/css" href="/baseweb/private/css/style.css" media="all"/>
		<!--[if IE 7]>
		<link rel="stylesheet" type="text/css" href="/baseweb/private/css/ie-style.css" media="all" />
		<![endif]-->		
		<?php $html->getHeader() ?>
    </head>
    <body>
		<div id="header" class="clearfix">
			<div id="logo">
				<h1><span>baseweb <strong>admin</strong></span></h1>
			</div>
	        <ul class="main-menu left">
	        	<?php foreach (Baseweb::getAdmins() as $name => $module): ?>
	            <li<?php echo $mainMenu == $name ? ' class="selected"' : '' ?>>
	            	<a href="/baseweb/private/<?php echo $module->getName() ?>/">
	            		<span><?php echo txt($module->getTitle())?></span>
					</a>
	            </li>
				<?php endforeach ?>
	        </ul>
			<ul class="main-menu right">
				<li>
					<a href="/">
						<span><?php echo txt('Exit')?></span>
					</a>
				</li>
			</ul>
		</div>
		<div id="sub-header" class="clearfix">
			<?php if ($admin && $admin->getActions()): ?>
			<ul class="sub-menu left">
				<?php foreach ($admin->getActions() as $title => $params): ?>
				<li>
					<form action="" method="post">
						<fieldset>
							<?php foreach ($params as $name => $value): ?>
							<input type="hidden" name="<?php echo $name ?>" value="<?php echo $value ?>" />
							<?php endforeach ?>
							<?php $html->button(txt($title), array('class' => 'dark', 'img' => '/baseweb/private/img/icons/83.png')) ?>
						</fieldset>
					</form>						
				</li>
				<?php endforeach?>
			</ul>
			<?php endif ?>
			<ul class="sub-menu right">
				<li>
					<form action="" method="post" class="help">
						<fieldset>
							<input type="hidden" name="action" value="help" />
							<?php $html->button(txt('Help'), array('img' => '/baseweb/private/img/icons/52.png', 'class' => 'dark')) ?>
						</fieldset>
					</form>
				</li>
			</ul>
		</div>
	