<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-12-25
 */
class Galleries extends Baseweb_Module implements Servable {

	const MODULE_NAME = 'galleries';

	// VARIABLES

	protected $name = Galleries::MODULE_NAME;
	
	// PUBLIC METHODS
	
	/*
	 * @implements Servable#doGet(Baseweb_Result $result = null)
	 */
	public function doGet(Baseweb_Result $result = null) {
		
		if (!$result)
			$result = new Baseweb_Result();
			
		if (isset($_GET['slug']))
			$result->gallery = $this->storage->getGallery(strval($_GET['slug']));
		else if (isset($_GET['id']))
			$result->gallery = $this->storage->getGallery(intval($_GET['id']));
		
		if (isset($_GET['page']))
			$page = intval($_GET['page']);
		else
			$page = null;
			
		if (isset($_GET['limit']))
			$limit = intval($_GET['limit']);
		else
			$limit = null;
			
		if (isset($_GET['mixed']))
			$mixed = strval($_GET['mixed']) === 'true';
		else
			$mixed = null;
			
		$result->galleries = $this->storage->getGalleries($page, $limit, $mixed);
		
		return $result;
	}
	
	/*
	 * @implements Servable#doPost(Baseweb_Result $result = null)
	 */
	public function doPost(Baseweb_Result $result = null) {
		
		if (!$result)
			$result = new Baseweb_Result();
			
		return $result;
	}	

	/**
	 * @param object $params[optional] Array of key value parameters, see below.
	 * @paeram 'mixed' Boolean if return value should be mixed form.
	 */
	public function getGalleryCount($params = array()) {
		
		$p = new Baseweb_Params($params, array('mixed' => false));
		return $this->storage->getGalleryCount($p->mixed);
	}

	/**
	 * @param object $params[optional] Array of key value parameters, see below.
	 * @param 'page' Page number for listing start.
	 * @param 'limit' Number of max galleries items in the list.
	 * @param 'mixed' Boolean if return value should be mixed form.
	 */
	public function getGalleries($params = array()) {
		
		$p = new Baseweb_Params($params, array('page' => 1, 'limit' => null, 'mixed' => false));		
		return $this->storage->getGalleries($p->page, $p->limit, $p->mixed);
	}

	public function getGallery($params = array()) {
		
		if (!is_array($params))
			$p = new Baseweb_Params(array('key' => $params));
		else
			$p = new Baseweb_Params($params, array('key' => null));
			
		return $this->storage->getGallery($p->key);
	}
}
