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
 * @created 2009-05-19
 */
class News extends Baseweb_Module implements Servable {

	const MODULE_NAME = 'news';

	// VARIABLES

	protected $name = News::MODULE_NAME;
	
	// PUBLIC METHODS
	
	/*
	 * @implements Servable#doGet(Baseweb_Result $result = null)
	 */
	public function doGet(Baseweb_Result $result = null) {
		
		if (!$result)
			$result = new Baseweb_Result();
			
		if (isset($_GET['slug']))
			$result->newsitem = $this->storage->getNewsitem(strval($_GET['slug']));
		else if (isset($_GET['id']))
			$result->newsitem = $this->storage->getNewsitem(intval($_GET['id']));
		
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
			
		$result->newslist = $this->storage->getNewslist($page, $limit, $mixed);
		
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
	public function getNewsCount($params = array()) {
		
		$p = new Baseweb_Params($params, array('mixed' => false));
		return $this->storage->getNewsCount($p->mixed);
	}

	/**
	 * @param object $params[optional] Array of key value parameters, see below.
	 * @param 'page' Page number for listing start.
	 * @param 'limit' Number of max news items in the list.
	 * @param 'mixed' Boolean if return value should be mixed form.
	 */
	public function getNews($params = array()) {
		
		$p = new Baseweb_Params($params, array('page' => 1, 'limit' => null, 'mixed' => false));		
		return $this->storage->getNewslist($p->page, $p->limit, $p->mixed);
	}

	public function getNewsitem($params = array()) {
		
		if (!is_array($params))
			$p = new Baseweb_Params(array('key' => $params));
		else
			$p = new Baseweb_Params($params, array('key' => null));
			
		return $this->storage->getNewsitem($p->key);
	}
}
