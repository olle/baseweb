<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-05-13
 */
function messages() {	
	global $MESSAGES;
  $msgs = parse_ini_file('messages.ini', true);
	$MESSAGES = $msgs;	
}

messages();
