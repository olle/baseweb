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
 * @since 2.0
 * @created 2009-05-14
 */
class GalleriesAdmin extends Baseweb_AdminModule implements Ajaxable {
	
  const ACTION_DELETE_IMAGE = 'deleteImage';
  const ACTION_REBUILD_THUMBNAILS = 'rebuildThumbnails';
	
	// VARIABLES
	
	protected $name = Galleries::MODULE_NAME;
	protected $title = 'Galleries';
	protected $path;
	
	// CONSTRUCTOR
	
	public function __construct() {

		parent::__construct();
		$this->path = dirname(__FILE__);
	}
	
	// PUBLIC METHODS

	/*
	 * @implements Installable#getModels()
	 */
	public function getModels() {
		return array(Gallery::CLASS_NAME);
	}
	
	/*
	 * @implements Administratable#getActions()
	 */	
	public function getActions() {
		return array('Create new' => array('action' => self::ACTION_NEW));
	}	
		
	/*
	 * @implements Servable#doPost()
	 */
	public function doPost(Baseweb_Result $result = null) {
		
		if (!$result) {
			$result = new Baseweb_Result();
		}
			
		$action = strval($_POST['action']);
		
		if ($action == self::ACTION_NEW) {
					
			$object = new Gallery();
			
		} else if ($action == self::ACTION_EDIT) {
					
			$object = $this->storage->getGallery(intval($_POST['id']));
						
		} else if ($action == self::ACTION_SAVE) {
				
			if (intval($_POST['id'])) {
				$object = $this->storage->getGallery(intval($_POST['id']));
			} else {
				$object = new Gallery();
			}
			
			$_POST['ip'] = $_SERVER['REMOTE_ADDR'];
							
			$object->merge($_POST);			
			if (!$object->isValid()) {
				$result->errors = $object->getErrorStack();
			} else {
				$object->save();
			}
			
		} else if ($action == self::ACTION_DELETE) {
			
			$object = $this->storage->getGallery(intval($_POST['id']));			
			if ($object->delete()) {
				unset($object);
			}
						
		} else if ($action == self::ACTION_HELP) {
			
			$result->help = $this->getHelp();
			
		} else if ($action == self::ACTION_DELETE_IMAGE) {
			
			$object = $this->storage->getGallery(intval($_POST['id']));
			
      $file = strval($_POST['image']);			      
			$filePath = $object->getAbsPath() . '/' . $file; 
						
      if (!@unlink($filePath)) {
        $result->error = new Baseweb_Result(array(
            'action' => $action,
            'code' => 'unkownError'
        ));
      }
						
		} else if ($action == self::ACTION_REBUILD_THUMBNAILS) {
			
			$object = $this->storage->getGallery(intval($_POST['id']));
			$filePath = $object->getAbsPath();
			$thumbnails = Baseweb_FileUtils::listFiles($filePath, new GalleryThumbnailsFilter());
			
			foreach ($thumbnails as $thumb) {
				!@unlink($filePath . '/' . $thumb);
			}
			
			$images = $object->getImages();
			
			foreach ($images as $image) {
				$source = $filePath . '/' . $image;
				Baseweb_ImageUtils::createThumbnail($source, Gallery::THUMBNAIL_SIZE);
			}
		}
				
		if (isset($object)) {
			$result->gallery = $object;
		} else {
			$result->gallery = new Gallery();
		}
				
		$result->galleries = $this->storage->getGalleries();
		
		return $result;		
	}
	
	/*
	 * @implements Servable#doGet()
	 */
	public function doGet(Baseweb_Result $result = null) {
		if (!$result) {
			$result = new Baseweb_Result();
		}
		$result->galleries = new Baseweb_Result($this->storage->getGalleries()->toArray(true));
		$result->gallery = new Gallery();
		return $result;
	}
	
	/*
	 * @implements Ajaxable#getAjaxURL()
	 */
	public function getAjaxURL() {
		return '/baseweb/modules/galleries/galleries-ajax.php';
	}
}