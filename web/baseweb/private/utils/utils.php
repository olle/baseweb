<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-05-19
 */
function button($text, $icon = null, $type = 'submit', $style = 'round_button') {
	
	if (!$type)
		$type = 'submit';
	
	if ($icon) {
		$style .= ' icon_button';
		return sprintf('<button type="%s" class="button %s"><span><img src="%s" alt="%s" /> %s</span></button>', $type, $style, $icon, $text, $text);
	} else {		
		return sprintf('<button type="%s" class="button %s"><span>%s</span></button>', $type, $style, $text);
	}
}
