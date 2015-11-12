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
 * @since 2.0
 * @created 2009-05-13
 */
class InstallAdmin extends Baseweb_AdminModule implements Ajaxable {

	const MODULE_NAME = 'install';

	// VARIABLES

	protected $name = self::MODULE_NAME;
	protected $title = 'Install';
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
		return array('Installation');
	}

	/**
	 * @implements Servable#doGet()
	 */
	public function doGet(Baseweb_Result $result = null) {

		if (!$result)
			$result = new Baseweb_Result();

		return $result;
	}

	/**
	 * @implements Servable#doPost()
	 */
	public function doPost(Baseweb_Result $result = null) {

		if (!$result)
			$result = new Baseweb_Result();

		$action = strval($_POST['action']);

		if ($action == 'install')
			$this->_install();
		else if ($action == 'help')
			$result->help = $this->getHelp();

		return $result;
	}

	public function getInstallations() {
		return $this->storage->getInstallations();
	}

	public function getInstallationsInfo() {

		$info = array();

		foreach ($this->storage->getInstallations() as $row) {
			$info[$row->key] = $row->value;
		}

		return new Baseweb_Result($info);
	}

	public function setInstalledVersion($version) {

		$this->storage->setInstalledVersion($version);
	}

	/**
	 * @implements Administratable#getActions()
	 */
	public function getActions() {
		// No actions available
	}

	/**
	 * @overrides Baseweb_AdminModule#install($addTestData);
	 */
	public function install($withFixtures) {

		Baseweb::getConnection()->dropDatabase();
		Baseweb::getConnection()->createDatabase();

		parent::install($withFixtures);

		$this->storage->addInstallations($this->_getInstallationsData());
	}

	/**
	 * @overrides Baseweb_AdminModule#update($toVersion)
	 */
	public function update($toVersion) {

		parent::update($toVersion);

		$this->storage->updateInstallations($this->_getInstallationsData());
	}

	// PRIVATE METHODS

	private function _getInstallationsData() {

		return array(
				'version' => Baseweb::getSettings()->APP_VERSION,
				'web-modules' => join(',', array_keys(Baseweb::getModules())),
				'admin-modules' => join(',', array_keys(Baseweb::getAdmins())),
		);
	}

	private function _install() {

		$conf = Baseweb::getSettings();

		if (!@mysql_select_db($conf->DB_NAME)) {
			mysql_query(sprintf('CREATE DATABASE IF NOT EXISTS %s', $conf->DB_NAME));
			mysql_close();
			mysql_connect($conf->DB_HOST, $conf->DB_USER, $conf->DB_PASSWORD);
			@mysql_query("SET NAMES 'utf8'");
			@mysql_set_charset('utf8');
			mysql_select_db($conf->DB_NAME);
		}

		mysql_query('SET FOREIGN_KEY_CHECKS = 0');

		foreach (Baseweb::getAdmins() as $name => $admin)
			$admin->install(isset($_POST['testdata']) ? true : false);

		mysql_query('SET FOREIGN_KEY_CHECKS = 1');
	}

	/*
	 * @implements Ajaxable#getAjaxURL()
	 */
	public function getAjaxURL() {
		return '/baseweb/modules/install/install-ajax.php';
	}

}
