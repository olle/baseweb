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
