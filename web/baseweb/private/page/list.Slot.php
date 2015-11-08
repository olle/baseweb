<?php if ($result->slots): ?>
	<h2><?php echo txt('Slots')?></h2>
	<ul class="slots">
		<?php foreach ($result->slots as $slot): ?>
		<li class="slot">
			<img src="/baseweb/private/img/icons/22.png" alt="" />
			<form action="" method="post" class="left">
				<fieldset>
					<?php $html->hidden('action', PageAdmin::ACTION_EDIT) ?>
					<?php $html->hidden('id', $slot->id) ?>
				</fieldset>
				<fieldset>
					<?php $html->submit($slot->getTitle()) ?>
				</fieldset>
			</form>
		</li>
		<?php endforeach  ?>
	</ul>
<?php $script =<<<EOT
<script type="text/javascript">
	jQuery('li.slot').click(function(ev) {
		jQuery('form', this).get(0).submit(); 
	});
</script>
EOT;
$html->addToFooter($script);
?>	
<?php endif ?>
