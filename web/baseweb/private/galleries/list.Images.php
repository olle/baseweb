<?php if ($result->gallery): ?>
<div class="sub-list clearfix">
	<h3><?php echo txt('Images and thumbnails in this gallery')?></h3>
	<?php $collection = $result->gallery->getImages() ?>
	<?php if (count($collection) > 0): ?>
	<ul class="images clearfix" id="image-list">
		<?php foreach ($collection as $image): ?>
		<li class="clearfix">
			<img src="/baseweb/private/img/transp.gif" alt="" />
			<p><?php echo $image ?></p>
			<form action="" method="post" class="right">				
				<fieldset>
					<?php $html->hidden('action', GalleriesAdmin::ACTION_DELETE_IMAGE) ?>
					<?php $html->hidden('id', $result->gallery->id) ?>
					<?php $html->hidden('image', $image) ?>
				</fieldset>
				<fieldset class="buttons">
					<?php $html->button(txt('Remove'), array('class' => 'rect passive')) ?>		
<?php 
$script =<<<EOT
<script type="text/javascript">
  jQuery('.delete-action').show().Confirm(function(confirmed, el) {
    if (confirmed) {
      var form = jQuery(el).parent().parent();
      form.find('input[name="action"]').attr('value', 'delete');
      form.submit();        
    }
  }, {
    'title' : txt('Delete employee?'),
    'text' : txt('Really delete the employee? This action cannot be undone.'),
    'ok' : txt('Ok'),
    'cancel' : txt('Cancel')
  });
</script>
EOT;
$html->addToFooter($script);
?>									
				</fieldset>
			</form>
		</li>
		<?php endforeach ?>
	</ul>
  <form action="" method="post">
    <fieldset>
      <?php $html->hidden('action', GalleriesAdmin::ACTION_REBUILD_THUMBNAILS) ?>
      <?php $html->hidden('id', $result->gallery->id) ?>
    </fieldset>
    <fieldset class="buttons">
      <?php $html->button(txt('Rebuild thumbnails')) ?>
    </fieldset>
  </form> 
	<?php else: ?>
	<p><?php echo txt('No files') ?></p>
	<?php endif ?>
</div>
<?php endif ?>