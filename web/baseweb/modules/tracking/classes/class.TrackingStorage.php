<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.x
 * @created 2009-07-03
 */
final class TrackingStorage extends Baseweb_Storage {
	
	// PUBLIC METHODS
	
	public function getNewVisitors() {
		
		$q = new Doctrine_Query();
		$q->from('Visitor');
		$q->where('archived = ?', false);
		
		return $q->execute();
	}
	
	public function getArchivedVisitors() {
		
		if (!$this->isAdmin)
			return null;
		
		$q = new Doctrine_Query();
		$q->from('Visitor');		
		$q->where('archived = ?', true);
		
		return $q->execute();
	}
	
	public function newVisitor($sid, $ip) {
		
		$visitor = new Visitor();
		
		$visitor->sid = $sid;
		$visitor->ip = $ip;
		
		$visitor->save();
		
		return $visitor;
	}
	
	public function getVisitor($key) {

		if (intval($key))
			return Doctrine::getTable('Visitor')->find(intval($key));
		else
			return Doctrine::getTable('Visitor')->findOneBySid(strval($key));

		return $visitor;
	}
	
	public function archiveVisitors() {
		
		$q = new Doctrine_Query();
		$q->update('Visitor');
		$q->set('archived', '?', true);
		$q->set('tracked', '?', false);
		$q->where('tracked = ?', true);
		$q->execute();
	}
	
	public function deleteVisitors() {
		
		$q = new Doctrine_Query();
		$q->delete('Visitor');
		$q->where('archived = ?', false);
		$q->execute();
	}
	
	public function archiveTracks($visitorId) {
		
		$q = new Doctrin_Query();
		$q->update('Track');
		$q->set('archived', '?', true);
		$q->where('visitor_id = ?', $visitorId);
		$q->execute();
	}
}
