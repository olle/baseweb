<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.x
 * @created 2009-07-03
 */
require ('../private.php');
require ('../../baseweb.php');

$mainMenu = 'tracking';
$html = Baseweb::getModule('html');

?><?php include('../header.php') ?>
	<div class="source-view">
		
		<ul class="visitors new">
			<h2><?php echo txt('Visitors') ?></h2>
			<?php if ($admin->isTracking()): ?>
			<li class="tracking">
				<img src="/baseweb/private/img/transp.gif" alt="" />
				<?php echo txt('Listening for visitors...') ?>
			</li>
			<?php else: ?>
			<li></li>
			<?php endif ?>
		</ul>
		
		<ul class="visitors archived">
			<h2><?php echo txt('Archived visitors') ?></h2>
			<?php foreach ($result->visitors as $visitor): ?>
			<?php $selected = ($result->visitor && $result->visitor->id == $visitor->id) ? 'selected' : '' ?>
			<li class="<?php echo $selected ?>">
				<img src="/baseweb/private/img/transp.gif" alt="" />
				<form action="" method="post">
					<fieldset>
						<input type="hidden" name="action" value="view" />
						<input type="hidden" name="id" value="<?php echo $visitor->id ?>" />
					</fieldset>
					<fieldset>
						<?php $html->submit($visitor->ip) ?>
					</fieldset>
				</form>	
			</li>
			<?php endforeach ?>
		</ul>
		
	</div>
	<div class="content-view high">
		<?php echo $result->help ?>	
		<ol class="tracks">
			<?php if ($result->visitor): ?>
			<?php foreach ($result->visitor->Tracks as $track): ?>
			<li>
				<div>
					<?php echo $track->created_at ?>
				</div>
			</li>
			<?php endforeach ?>
			<?php endif ?>
		</ol>	
	</div>
<?php

if ($admin->isTracking()) {
	
	$html->addToFooter('<script type="text/javascript" src="tracker.js"></script>');	
}
?>
<?php include('../footer.php') ?>