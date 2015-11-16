<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.1
 * @created 2009-09-26
 */
require ('../private.php');
require ('../../baseweb.php');

header('content-type: application/javascript'); ?>
if (typeof Baseweb === 'undefined')
	window.Baseweb = {};
	
Baseweb.MESSAGES = <?php echo json_encode($MESSAGES) ?>;

txt = function (message) {
	if (typeof Baseweb.MESSAGES[Baseweb.APP_LANGUAGE][message] !== 'undefined')
		return Baseweb.MESSAGES[Baseweb.APP_LANGUAGE][message];
	else if (Baseweb.APP_DEBUG === '1' && Baseweb.APP_LANGUAGE !== 'en')
		return '[l10n error ' + Baseweb.APP_LANGUAGE + ']: ' + message;
	else
		return message;
};

dtxt = function (message, args) {
	var _args = Array.prototype.slice.call(arguments);
	_message = txt(_args.shift());
	return sprintf(_message, _args);
};

ctxt = function (condition, trueMessage, falseMessage) {
	if (condition)
		return txt(trueMessage);
	else
		return txt(falseMessage);
};