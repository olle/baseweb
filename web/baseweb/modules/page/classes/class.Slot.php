<?php

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
