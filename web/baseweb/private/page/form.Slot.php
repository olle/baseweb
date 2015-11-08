<?php if ($result->slot): ?>
<?php 
$script =<<<EOT
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
<div class="slot edit clearfix">
	<form action="" method="post">
		<fieldset>
			<?php $html->hidden('action', PageAdmin::ACTION_SAVE) ?>
			<?php $html->hidden('id', $result->slot->id) ?>
		</fieldset>
		<fieldset class="editor">
			<?php $html->hidden('article_id', $result->slot->Article->id) ?>
			<?php $html->textarea('content', $result->slot->Article->content, 80, 20) ?>
		</fieldset>
    <fieldset class="buttons">
      <?php $html->button(ctxt($result->slot->id, 'Save changes', 'Save'), array('img' => '/baseweb/private/img/icons/10.png')) ?>
      <?php $html->button(txt('Cancel'), array('img' => '/baseweb/private/img/icons/2.png', 'class' => 'close-action', 'style' => 'display: none;')) ?>
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
            'disabled' => $result->slot->id ? '' : 'disabled'
      )) ?>
<?php 
$title = txt('Delete slot?');
$text = txt('Really delete this slot? This action cannot be undone.');
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
EOT;
$html->addToFooter($script);
?>          
    </fieldset>
		<!--
		<fieldset class="buttons">
			<?php $html->button(ctxt($result->slot->id, 'Save changes', 'Save'), array('img' => '/baseweb/private/img/icons/10.png')) ?>
		</fieldset>
		-->
	</form>
</div>
<?php endif ?>