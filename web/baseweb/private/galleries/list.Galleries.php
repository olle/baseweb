<?php if ($result->galleries->count() > 0): ?>
	<h2><?php echo txt('Galleries')?></h2>
	<ul class="galleries">
		<?php foreach ($result->galleries as $index => $gallery): ?>
		<?php $status = $gallery->status ? '' : 'inactive ' ?>
		<?php $selected = ($result->gallery && $result->gallery->id == $gallery->id) ? 'selected' : '' ?>
		<li class="<?php echo $status, $selected ?>" id="gallery-<?php echo $gallery->id ?>">
			<img src="/baseweb/private/img/icons/photo.png" alt="" />
			<form action="" method="post" class="left">
				<fieldset>
					<?php $html->hidden('action', GalleriesAdmin::ACTION_EDIT) ?>
					<?php $html->hidden('id', $gallery->id) ?>
				</fieldset>
				<fieldset>
					<?php $html->submit($gallery->title) ?>
				</fieldset>
			</form>
		</li>
		<?php endforeach ?>
	</ul>
<?php $script =<<<EOT
<script type="text/javascript">
	jQuery('.source-view .galleries li').click(function(el) {
		jQuery('form', this).get(0).submit();
	});
</script>
EOT;
$html->addToFooter($script);
?>		
<?php endif ?>
