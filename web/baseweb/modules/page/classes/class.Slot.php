<?php
/*
 * Copyright (c) Olle Törnström studiomediatech.com 2008-2009
 *
 * THIS CODE IS PROPRIETARY AND PROTECTED BY COPYRIGHT LAW AGAINST COPYING,
 * RE-DISTRIBUTION, PUBLISHING OR DE-COMPILATION WITHOUT THE PRIOR WRITTEN
 * CONSENT OF THE AUTHOR. USAGE IS CONTROLLED BY A LICENSE AGREEMENT,
 * REGULATING THE SPECIFIC, UNIQUE, NON EXCLUSIVE RIGHTS TO RUN, USE OR
 * INCLUDE THE CODE IN WHOLE, PART, COMPILED OR DECOMPILED FORM.
 */
/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.2
 * @created 2009-09-22
 */
class Slot extends BaseSlot {

	const CLASS_NAME = 'Slot';

	// PUBLIC METHODS
	
	public function getContent() {

		$content = '<div class="slot ' . $this->name . '">';
		$content .= $this->Article ? $this->Article->content : '';
		$content .= '</div>';
		return $content;
	}
	
	public function getTitle() {
		return str_replace('index.php', '', $this->address) . '#' . $this->name; 
	}
}
