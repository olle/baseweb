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
 * @since 2.1
 * @created 2009-07-20
 */
class MediaAdmin extends Baseweb_AdminModule implements Ajaxable {

	const MODULE_NAME = 'media';

	const ACTION_UPLOAD_FILE = 'uploadFile';
	const ACTION_DELETE_FILE = 'deleteFile';
	const ACTION_DELETE_FOLDER = 'deleteDir';
	const ACTION_CREATE_FOLDER = 'createDir';
	
	protected $name = self::MODULE_NAME;
	protected $title = 'Media';
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
	}
	
	/*
	 * @implements Administratable#getActions()
	 */	
	public function getActions() {
	}
	
	/*
	 * @implements Servable#doPost()
	 */
	public function doPost(Baseweb_Result $result = null) {

		if (!$result)
			$result = new Baseweb_Result();

		$action = strval($_POST['action']);

		if ($action === self::ACTION_CREATE_FOLDER) {
			
			$dir = strval($_POST['currentDir']);
			$name = strval($_POST['name']);
			try {
				if (!@mkdir($dir . DIRECTORY_SEPARATOR . $name)) {
					$result->error = new Baseweb_Result(array(
							'action' => $action,
							'code' => 'notAllowed'
					));
				}
			} catch (Exception $e) {}
			
		} else if ($action === self::ACTION_DELETE_FOLDER) {
			
			$dir = strval($_POST['currentDir']);
			
			if ($dir === Baseweb::getSettings()->APP_DATADIR) {
				
				$result->error = new Baseweb_Result(array(
						'action' => $action,
						'code' => 'permissionDenied'
				));
				
			} else {

				try {
					if (!@rmdir($dir)) {
						$result->error = new Baseweb_Result(array(
								'action' => $action,
								'code' => 'notAllowed'
						));
					}
				} catch (Exception $e) {}
			}
			
		} else if ($action === self::ACTION_UPLOAD_FILE) {

			$tempFile = $_FILES['files']['tmp_name'];
			$targetPath = $_POST['currentDir'] . '/';
			$targetFile =  str_replace('//','/',$targetPath) . $_FILES['files']['name'];
	
			if (!@move_uploaded_file($tempFile,$targetFile)) {
				$result->error = new Baseweb_Result(array(
						'action' => $action,
						'code' => 'unkownError'
				));
			}
			
		} else if ($action === self::ACTION_DELETE_FILE) {
			
			$file = strval($_POST['currentFile']);			
			if (!@unlink($file)) {
				$result->error = new Baseweb_Result(array(
						'action' => $action,
						'code' => 'unkownError'
				));
			}
		}

		return $result;		
	}
	
	/*
	 * @implements Servable#doGet()
	 */
	public function doGet(Baseweb_Result $result = null) {
		
		if (!$result)
			$result = new Baseweb_Result();
		
		return $result;
	}
	
	
	/*
	 * @implements Ajaxable#getAjaxURL()
	 */
	public function getAjaxURL() {
		return '/baseweb/modules/media/media-ajax.php';
	}	
	
}