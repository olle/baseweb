<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-06-19
 */
class Newsitem extends BaseNewsitem {

	const CLASS_NAME = 'Newsitem';

	// PUBLIC METHODS

	public function __toString() {
		return '[' . $this->author . '@' . $this->updated_at . ']: ' . $this->title;
	}
}
