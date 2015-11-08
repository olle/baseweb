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
 * @since 2.1
 * @created 2009-09-25
 */
class UpdateAdmin extends Baseweb_AdminModule implements Ajaxable {
	
	const MODULE_NAME = 'update';
	const ACTION_UPDATE = 'update';
	
	// VARIABLES
	
	protected $name = self::MODULE_NAME;
	protected $title = 'Update';
	protected $path;
	
	private $installAdmin;
	
	// CONSTRUCTOR
	
	public function __construct() {
		parent::__construct();
		$this->path = dirname(__FILE__);
		$this->installAdmin = new InstallAdmin();
	}
		
	// PUBLIC METHODS
	
	/*
	 * @implements Installable#getModels()
	 */
	public function getModels() {
		return array('UpdateVersion', 'UpdateModules', 'UpdateModule');
	}	
	
	/**
	 * @implements Servable#doGet()
	 */
	public function doGet(Baseweb_Result $result = null) {

		if (!$result)
			$result = new Baseweb_Result();
		
		$result->installInfo = $this->installAdmin->getInstallationsInfo();
		
		if (Baseweb::getSettings()->APP_VERSION === $result->installInfo->version)
			$result->isUpToDate = true;
			
		return $result;
	}
	
	/**
	 * @implements Servable#doPost()
	 */
	public function doPost(Baseweb_Result $result = null) {

		if (!$result)
			$result = new Baseweb_Result();
			
		$action = strval($_POST['action']);

		if ($action == self::ACTION_UPDATE)
			$this->_update();
		else if ($action == 'help')
			$result->help = $this->getHelp();
		
		$result->installInfo = $this->installAdmin->getInstallationsInfo();
		
		if (Baseweb::getSettings()->APP_VERSION === $result->installInfo->version)
			$result->isUpToDate = true;
		
		return $result;
	}

	/**
	 * @implements Administratable#getActions()
	 */	
	public function getActions() {
		// No actions available
	}
	
	// PRIVATE METHODS
	
	private function _update() {

		$this->_ensureInstalled();

		$version = new UpdateVersion();
		$version->number = Baseweb::getSettings()->APP_VERSION;
		$version->save();

		foreach (Baseweb::getAdmins() as $name => $admin) {
			
			$module = new UpdateModule();
			$module->name = $name;
			$module->migration = intval($admin->update(null));
			$module->save();
			
			$link = new UpdateModules();
			$link->version_id = $version->id;
			$link->module_id = $module->id;
			$link->save();			
		}
		
		$installAdmin = new InstallAdmin();
		$installAdmin->setInstalledVersion($version->number);
	}
	
	/*
	 * @implements Ajaxable#getAjaxURL()
	 */
	public function getAjaxURL() {
		return '/baseweb/modules/update/update-ajax.php';
	}
	
}