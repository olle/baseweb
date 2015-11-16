<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-06-17
 */
interface HelpEnabled {

	/**
	 * @return Help for the implementing module, current language and version.
	 */
	public function getHelp();
}
