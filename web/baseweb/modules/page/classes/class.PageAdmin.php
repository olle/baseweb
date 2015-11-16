<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.2
 * @created 2009-09-22
 */
class PageAdmin extends Baseweb_AdminModule implements Ajaxable {
	
	// VARIABLES
	
	protected $name = Page::MODULE_NAME;
	protected $title = 'Page';
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

		return array(
				Article::CLASS_NAME,
				Slot::CLASS_NAME, 
		);
	}
	
	/*
	 * @implements Administratable#getActions()
	 */	
	public function getActions() {
		return null; //array('Create new' => array('action' => self::ACTION_NEW));
	}
	
	/*
	 * @implements Servable#doPost()
	 */
	public function doPost(Baseweb_Result $result = null) {

		if (!$result)
			$result = new Baseweb_Result();
			
		$action = strval($_POST['action']);
		
		if ($action === self::ACTION_EDIT) {
		
			$slot = $this->storage->getSlotById(intval($_POST['id']));
			
			if (!$slot->Article) {
				$a = new Article();
				$a->save();
				$slot->article_id = $a->id;
				$slot->save();
				$slot->refreshRelated();
			}
			
			$result->slot = $slot;
				
		} else if ($action === self::ACTION_SAVE) {
			
			$slot = $this->storage->getSlotById(intval($_POST['id']));
			
			if (!$slot->Article)
				$slot->Article = new Article();
				
			$slot->Article->content = stripslashes($_POST['content']);
			
			$slot->Article->save();
			$slot->save();
			
			$result->slot = $slot;
		
		} else if ($action == self::ACTION_DELETE) {

      $slot = $this->storage->getSlotById(intval($_POST['id']));
  	
	    if ($slot && $slot->delete()) {
	    	$article = $slot->Article;
	    	unset($slot);
				$article->delete();
				unset($article);
	    }
			
		} else if ($action == self::ACTION_HELP) {

			$result->help = $this->getHelp();
		}
		
		$result->slots = $this->storage->getSlots();
		
		return $result;
	}
	
	/*
	 * @implements Servable#doGet()
	 */
	public function doGet(Baseweb_Result $result = null) {
		
		if (!$result)
			$result = new Baseweb_Result();
			
		$result->slots = $this->storage->getSlots();
			
		return $result;
	}
	
	/*
	 * @implements Ajaxable#getAjaxURL()
	 */
	public function getAjaxURL() {
		return '/baseweb/modules/page/page-ajax.php';
	}	
}
