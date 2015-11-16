<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-05-14
 */
class NewsAdmin extends Baseweb_AdminModule implements Ajaxable {
	
	// VARIABLES
	
	protected $name = News::MODULE_NAME;
	protected $title = 'News';
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

		return array(Newsitem::CLASS_NAME);
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

		if (!$result)
			$result = new Baseweb_Result();

		$action = strval($_POST['action']);
		
		if ($action == self::ACTION_NEW) {
			
			$object = new Newsitem();
			
		} else if ($action == self::ACTION_EDIT) {
			
			$object = $this->storage->getNewsitem(intval($_POST['id']));
			
		} else if ($action == self::ACTION_SAVE) {
	
			if (intval($_POST['id']))
				$object = $this->storage->getNewsitem(intval($_POST['id']));
			else
				$object = new Newsitem();
				
			$_POST['ip'] = $_SERVER['REMOTE_ADDR'];
				
			$object->merge($_POST);
			
			if (!$object->isValid()) {
				$result->errors = $object->getErrorStack();
			} else {
				$object->save();
			}

		} else if ($action == self::ACTION_DELETE) {

			$object = $this->storage->getNewsitem(intval($_POST['id']));
			
			if ($object->delete())
				unset($object);
			
		} else if ($action == self::ACTION_HELP) {

			$result->help = $this->getHelp();
		}
		
		if (isset($object))
			$result->newsitem = $object;
		else
			$result->newsitem = new Newsitem();
		
		$result->news = $this->storage->getNewslist();

		return $result;		
	}
	
	/*
	 * @implements Servable#doGet()
	 */
	public function doGet(Baseweb_Result $result = null) {
		
		if (!$result)
			$result = new Baseweb_Result();
			
		$result->news = new Baseweb_Result($this->storage->getNewslist()->toArray(true));
		$n = new Newsitem();
		$result->newsitem = new Baseweb_Result($n->toArray());
		
		return $result;
	}
	
	/*
	 * @implements Ajaxable#getAjaxURL()
	 */
	public function getAjaxURL() {
		return '/baseweb/modules/news/news-ajax.php';
	}
}