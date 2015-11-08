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
 * @created 2010-12-25
 */
class Gallery extends BaseGallery {

	const CLASS_NAME = 'Gallery';
	const THUMBNAIL_SIZE = 120;

	// PUBLIC METHODS

	public function __toString() {
		return $this->title;
	}
	
	public function getPath() {
		return Baseweb::getSettings()->APP_DATAPATH . '/' . $this->path;
	}
	
	public function getAbsPath() {
		return Baseweb::getSettings()->APP_DATADIR . '/' . $this->path;
	}
	
	public function getThumbnails() {
		$thumbnails = Baseweb_FileUtils::listFiles($this->getAbsPath(), new GalleryThumbnailsFilter());
		$result = array();
		foreach ($thumbnails as $thumb) {			
			$result[] = new Thumbnail($this->getPath() . '/' . $thumb);
		}
		return $result;
	}
	
	public function getImages() {
		return Baseweb_FileUtils::listFiles($this->getAbsPath(), new GalleryImageFilter());
	}
}
