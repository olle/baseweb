<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-06-17
 */
class AdminAdmin extends Baseweb_AdminModule implements Ajaxable {
	
	// VARIABLES
	
	protected $name = Admin::MODULE_NAME;	
	protected $title = 'Home';
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
		// No models in the admin module.
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
	 * @implements Servable#doPost()
	 */
	public function doPost(Baseweb_Result $result = null) {

		if (!$result)
			$result = new Baseweb_Result();

		$action = strval($_POST['action']);
		
		if ($action == 'help')			
			$result->help = $this->getHelp();
	
		return $result;			
	}	

	/*
	 * @implements Administratable#getActions()
	 */
	public function getActions() {
		// No actions
	}

	/**
	 * Prevents any model installations for this module.
	 * @overrides Installable#install($addTestData)
	 */	
	public function install($addFixtures) {
		// Nothing to install
	}
	
	/*
	 * @implements Ajaxable#getAjaxURL()
	 */
	public function getAjaxURL() {
		return '/baseweb/modules/admin/admin-ajax.php';
	}
}
