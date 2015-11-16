<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-07-17
 */
class InstallStorage extends Baseweb_Storage {
	
	// PUBLIC METHODS
	
	public function getInstallations() {
		
		if (!$this->isAdmin)
			return null;
		
		$q = new Doctrine_Query();
		$q->from('Installation');
		
		return $q->execute();
	}
	
	public function getInstallationInfo($key) {
		
		if (!$this->isAdmin)
			return null;
			
		$q = new Doctrine_Query();
		$q->select('value as value');
		$q->from('Installation');
		$q->where('key = ?', $key);
		$q->fetchOne();
		return $q->execute()->get(0);
	}
	
	public function addInstallations($data) {
				
		foreach ($data as $key => $value) {
			$i = new Installation();
			$i->key = $key;
			$i->value = $value;
			$i->save();
		}		
	}
	
	public function updateInstallations($data) {
		
		foreach ($data as $key => $value) {
			$q = new Doctrine_Query();
			$q->from('Installation');
			$q->where('key = ?', $key);
			$r = $q->fetchOne();
			$r->value = $value;
			$r->save();
		}
	}
	
	public function setInstalledVersion($version) {
		
		if (!$this->isAdmin)
			return;
			
		$q = new Doctrine_Query();
		$q->update('Installation');
		$q->set('value', '?', $version);
		$q->where('key = ?', 'version');
		$q->execute();
	}
}
