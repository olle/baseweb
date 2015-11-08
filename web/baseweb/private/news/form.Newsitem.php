		<?php if ($result->newsitem): ?>
		<div class="newsitem">
			<form action="" method="post" id="edit-news-form">
				<fieldset>
					<?php $html->hidden('action', 'save') ?>
					<?php $html->hidden('id', $result->newsitem->id) ?>
				</fieldset>
				<fieldset>
					<?php $html->label('title', txt('Title'), $result->errors) ?>
					<?php $html->input('title', $result->newsitem->title) ?>
				</fieldset>
				<fieldset>
					<?php $html->label('body', txt('Body'), $result->errors) ?>
					<?php $html->textarea('body', $result->newsitem->body, 80, 12) ?>
				</fieldset>
				<fieldset>
					<?php $html->hidden('status', 0) ?>
					<?php $html->checkbox('status', 1, $result->newsitem->status) ?>
					<?php $html->label('status', txt('Published')) ?>
				</fieldset>
				<?php if ($result->newsitem->id): ?>
				<fieldset>
					<?php $html->label('created', txt('Created')) ?>
					<span class="readonly"><?php echo $result->newsitem->created_at ?></span>
				</fieldset>
				<fieldset>
					<?php $html->label('modified', txt('Modified')) ?>
					<span class="readonly"><?php echo $result->newsitem->updated_at ?></span>
				</fieldset>
				<?php endif ?>
				<fieldset>
					<?php $html->label('author', txt('Author'), $result->errors) ?>
					<?php $html->input('author', $result->newsitem->author) ?>
				</fieldset>		
				<fieldset class="buttons">
					<?php $html->button(ctxt($result->newsitem->id, 'Save changes', 'Save'), array('img' => '/baseweb/private/img/icons/10.png', 'type' => 'submit')) ?>
					<?php $html->button(txt('Cancel'), array(
								'img' => '/baseweb/private/img/icons/2.png', 
								'class' => 'close-action', 
								'style' => 'display: none;', 
								'disabled' => $result->newsitem->id ? '' : 'disabled'
					)) ?>
<?php $script =<<<EOT
<script type="text/javascript">
	jQuery('.close-action').css({'display' : 'block'}).click(function(ev) {
		ev.preventDefault();
		var form = jQuery(this).parent().parent();
		form.find('input[name="action"]').attr('value', 'close');
		form.submit();
	});
</script>
EOT;
$html->addToFooter($script);
?>				
					<?php $html->button(txt('Delete'), array(
								'img' => '/baseweb/private/img/icons/86.png', 
								'class' => 'delete-action', 
								'style' => 'display: none;',
								'disabled' => $result->newsitem->id ? '' : 'disabled'
					)) ?>
<?php 
$title = txt('Delete newsitem?');
$text = txt('Really delete the newsitem? This action cannot be undone.');
$ok = txt('Ok');
$cancel = txt('Cancel');
$script =<<<EOT
<script type="text/javascript">
	jQuery('.delete-action').show().Confirm(function(confirmed, el) {
		if (confirmed) {
			var form = jQuery(el).parent().parent();
			form.find('input[name="action"]').attr('value', 'delete');
			form.submit();				
		}
	}, {
		'title' : '$title',
		'text' : '$text',
		'ok' : '$ok',
		'cancel' : '$cancel'
	});
</script>
<script type="text/javascript" src="/baseweb/private/js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="/baseweb/private/js/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('textarea').tinymce({
			script_url : '/baseweb/private/js/tiny_mce/tiny_mce.js',
			theme : "advanced",
			skin : 'o2k7',
			skin_variant : "silver",
			plugins : "safari",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_resizing : true,
			theme_advanced_buttons1 : "cleanup,|,undo,redo,|,formatselect,bold,italic,underline,strikethrough,|,bullist,numlist,|,blockquote,hr,|,link,unlink,anchor,image,|,charmap",
			theme_advanced_buttons2 : '',
			theme_advanced_buttons3 : '',
			content_css : '/baseweb/private/css/cms.css',
		});
	});
</script>
EOT;
$html->addToFooter($script);
?>								
				</fieldset>
			</form>
		</div>
		<?php endif ?>