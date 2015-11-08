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
 * @created 2010-12-27
 */
abstract class Baseweb_ImageUtils {
	
	// PUBLIC FUNCTIONS

  /**
   * Creating and saving a, overwriting any already existing, thumbnail of the 
   * passed image, naming it with the suffix '_tn' and the image extension.
   * 
   * @param object $image path to the source image
   * @param object $size target size of the largest side of the image (width or
   *               height.
   * 
   * @return the path to the newly created thumbnail
   */
  public static function createThumbnail($image, $size) {

		$thumbnailSuffix = '_tn';
    $imageParts = str_split($image, strpos($image, '.jpg'));       
    $dest = $imageParts[0] . $thumbnailSuffix . $imageParts[1];

    list($width, $height) = getimagesize($image);

    if ($width > $height) {
      $percent = $size / $width;
    } else {
      $percent = $size / $height;
    }
    
    $tn_width = $width * $percent;
    $tn_height = $height * $percent;    

    $thumb = imagecreatetruecolor($tn_width, $tn_height);
    $img_source = imagecreatefromjpeg($image);

    imagecopyresized($thumb, $img_source, 0, 0, 0, 0, $tn_width, $tn_height, $width, $height);
    imagejpeg($thumb, $dest, 55);
		
		return $dest;      
  }
}
