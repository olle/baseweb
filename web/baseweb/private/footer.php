		<script type="text/javascript" src="/baseweb/private/js/baseweb.php"></script>
		<script type="text/javascript" src="/baseweb/private/js/sprintf.js"></script>
		<script type="text/javascript" src="/baseweb/private/js/l10n.php"></script>
		<script type="text/javascript" src="/baseweb/private/js/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="/baseweb/private/js/jquery.reset-event.js"></script>
		<script type="text/javascript" src="/baseweb/private/js/jquery.confirm.js"></script>		
		<script type="text/javascript">
			jQuery.fn.Confirm.defaults.addStyle = false;
			jQuery.fn.Confirm.defaults.okIcon = '/baseweb/private/img/icons/10.png';
			jQuery.fn.Confirm.defaults.cancelIcon = '/baseweb/private/img/icons/12.png';
		</script>
		<script type="text/javascript" src="/baseweb/private/js/jquery.help.js"></script>		
		<script type="text/javascript">
			jQuery.fn.Help.defaults.addStyle = false;
			jQuery.fn.Help.defaults.closeIcon = '/baseweb/private/img/icons/12.png';
			<?php if ($admin instanceof Ajaxable): ?>
				jQuery('form.help button').Help('<?php echo $admin->getAjaxURL() ?>', {close : '<?php echo txt('Close') ?>'});
			<?php endif ?>
		</script>
		<script type="text/javascript" src="/baseweb/private/js/jquery.inlineForm.js"></script>		
		<?php $html->getFooter() ?>
    </body>
</html>