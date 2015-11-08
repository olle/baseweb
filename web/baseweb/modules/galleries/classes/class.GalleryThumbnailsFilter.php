<?php
/*
 * Copyright (c) Olle Törnström studiomediatech.com 2010
 *
 * THIS CODE IS PROPRIETARY AND PROTECTED BY COPYRIGHT LAW AGAINST COPYING,
 * RE-DISTRIBUTION, PUBLISHING OR DE-COMPILATION WITHOUT THE PRIOR WRITTEN
 * CONSENT OF THE AUTHOR. USAGE IS CONTROLLED BY A LICENSE AGREEMENT,
 * REGULATING THE SPECIFIC, UNIQUE, NON EXCLUSIVE RIGHTS TO RUN, USE OR
 * INCLUDE THE CODE IN WHOLE, PART, COMPILED OR DECOMPILED FORM.
 */
/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.1
 * @created 2010-12-26
 */
class GalleryThumbnailsFilter extends Baseweb_FileFilter {

	// PUBLIC METHODS

  public function filter($files) {
    $result = array();
		foreach ($files as $item) {
			if (strstr($item, '_tn.jpg')) {
				$result[] = $item;
			}
		}
		return $result;
  }
}
