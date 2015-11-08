<?php
/*
 * Copyright (c) Olle Törnström studiomediatech.com 2009
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
function txt($message) {

	global $MESSAGES;
	
	$conf = Baseweb::getSettings();
	
	if (isset($MESSAGES[$conf->APP_LANGUAGE][$message])) {
		return $MESSAGES[$conf->APP_LANGUAGE][$message];
	} else if ($conf->APP_DEBUG == true && $conf->APP_LANGUAGE != 'en') {
		return '[l10n error ' . $conf->APP_LANGUAGE . ']: ' . $message;
	} else {
		return $message;
	}		
}

function dtxt($message, $arg1) {
	
	$args = func_get_args();
	$args[0] = txt($message);
	return call_user_func_array('sprintf', $args);
}

function ctxt($condition, $trueMessage, $falseMessage) {
	if ($condition) {
		return txt($trueMessage);
	} else {
		return txt($falseMessage);
	}
}
