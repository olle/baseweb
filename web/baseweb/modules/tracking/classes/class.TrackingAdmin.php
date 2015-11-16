<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.x
 * @created 2009-07-03
 */
class TrackingAdmin extends Baseweb_AdminModule implements Ajaxable {
	
	const MODULE_NAME = 'tracking';
	
	const ACTION_START = 'start';
	const ACTION_STOP = 'stop';
	const ACTION_VIEW = 'view';
	
	// VARIABLES
	
	protected $name = self::MODULE_NAME;
	protected $title = 'Tracking';
	protected $path;
	
	private static $isTracking = false;
	
	// CONSTRUCTOR
	
	public function __construct() {
		parent::__construct();
		$this->path = dirname(__FILE__);
	}

	// PUBLIC METHODS

	public function isTracking() {
		return TrackingStatus::isTracking();
	}
	
	public function setTracking($isTracking) {
		TrackingStatus::setTracking($isTracking);
	}

	public function pollVisitors() {
			
		return $this->storage->getNewVisitors();			
	}
	
	public function startTrackingVisitor(Visitor $visitor) {

		$visitor->tracked = true;
		$visitor->save();
	}
	
	public function stropTrackingVisitor(Visitor $visitor) {
		
		$v = $this->storage->getVisitor($visitorId);
		$this->storage->archiveTracks($v->id);		
		$v->tracked = false;
		$v->save();
	}
	
	public function pollTracks($visitorId) {

		$q = new Doctrine_Query();
		$q->from('Track');
		$q->where('archived = ?', false);
		$q->andWhere('visitor_id = ?', $visitorId);
		$q->orderBy('created_at ASC');
			
		$tracks = $q->execute();
		
		$ids = array();
		
		if ($tracks) {
			foreach ($tracks as $track) {
				$ids[] = intval($track->id);			
			}
		}
	
		$q2 = new Doctrine_Query();
		$q2->update('Track');
		$q2->set('archived', '?', true);
		$q2->whereIn('id', $ids);
		$q2->execute();
				
		return $tracks;
	}

	/*
	 * @implements Installable#getModels()
	 */
	public function getModels() {

		return array('TrackingStatus', 'Visitor', 'Track');
	}
	
	/*
	 * @implements Servable#doGet()
	 */
	public function doGet(Baseweb_Result $result = null) {
		
		if (!$result)
			$result = new Baseweb_Result();
			
		$result->visitors = $this->storage->getArchivedVisitors();
			
		return $result;
	}
	
	/*
	 * @implements Servable#doPost()
	 */
	public function doPost(Baseweb_Result $result = null) {

		if (!$result)
			$result = new Baseweb_Result();

		$action = strval($_POST['action']);
		
		if ($action == self::ACTION_START)
			$this->_actionStart();			
		else if ($action == self::ACTION_STOP)
			$this->_actionStop();
		else if ($action == self::ACTION_VIEW)
			$this->_actionView(&$result);
		
		if ($action == 'help')			
			$result->help = $this->getHelp();
	
		$result->visitors = $this->storage->getArchivedVisitors();
	
		return $result;			
	}	

	/*
	 * @implements Administratable#getActions()
	 */
	public function getActions() {
		
		if ($this->isTracking())
			return array('Stop tracking' => array('action' => self::ACTION_STOP));			
		else
			return array('Start tracking' => array('action' => self::ACTION_START));
	}
	
	/*
	 * @implements Ajaxable#getAjaxURL()
	 */
	public function getAjaxURL() {
		return '/baseweb/modules/tracking/tracking-ajax.php';
	}
	
	// PRIVATE METHODS
	
	private function _actionStart() {
	
		$this->setTracking(true);
	}
	
	private function _actionStop() {
		
		// 1. archive tracked visistors...
		
		$this->storage->archiveVisitors();
		$this->storage->deleteVisitors();
		$this->setTracking(false);
	}
	
	private function _actionView(Baseweb_Result $result) {
		
		if ($this->isTracking())
			$this->_actionStop();
			
		$result->visitor = $this->storage->getVisitor(intval($_POST['id']));
	}
}
