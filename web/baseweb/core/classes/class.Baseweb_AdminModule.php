<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-06-19
 */
abstract class Baseweb_AdminModule implements Module, Administratable, Installable, Updatable, Servable, HelpEnabled {
	
	const ACTION_NEW = 'new';
	const ACTION_EDIT = 'edit';
	const ACTION_SAVE = 'save';
	const ACTION_DELETE = 'delete';
	const ACTION_HELP = 'help';
	
	// VARIABLES
	
	protected $storage;
	
	// CONSTRUCTOR
	
	public function __construct() {
		
		$classname = ucfirst($this->getName()) . 'Storage';

		if (class_exists($classname)) {
			$this->storage = new $classname;
			$this->storage->setAdmin(true);
		}
	}
	
	// PUBLIC METHODS

	/**
	 * @implements Module#getName()
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @implements Administratable#getModulePath()
	 */
	public function getModulePath() {
		return realpath(dirname($this->path));
	}
	
	/** 
	 * @implements Administratable#getTitle()
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @implements Installable#doInstall($withFixtures)
	 */
	public function install($withFixtures) {
		
		if ($this->getModels())
			Doctrine::createTablesFromArray($this->getModels());
			
		if (!$withFixtures)
			return;
		
		$fixtures = $this->getModulePath() . '/fixtures/fixtures_' . Baseweb::getSettings()->APP_LANGUAGE . '.yml';
		
		if (!file_exists($fixtures))
			$fixtures = $this->getModulePath() . '/fixtures/fixtures.yml';
		
		if ($withFixtures && file_exists($fixtures))
			Doctrine::loadData($fixtures);
	}
	
	/**
	 * @implements Updatable#update($toVersion)
	 */
	public function update($toVersion) {
		
		$this->_ensureInstalled();

		$migrationPath = $this->getModulePath() . '/migrations/';

		if (!is_dir($migrationPath))
			return;
			
		$migration = new Doctrine_Migration($migrationPath);
				
		$version = 0;
						
		try {
			$version = $migration->migrate($toVersion);
		} catch (Doctrine_Migration_Exception $e) {		
			if (strpos($e->getMessage(), 'Already at version') === false)
				throw new Error($e);					
		}
		
		return $version;
	}
	
	/**
	 * @implements HelpEnabled#getHelp()
	 */
	public function getHelp() {
		
		return file_get_contents($this->getModulePath() . '/help//help_' . Baseweb::getSettings()->APP_LANGUAGE . '.html');
	}
	
	// PROTECTED METHODS
	
	protected function _ensureInstalled() {
		
		$models = $this->getModels();
		
		if (!empty($models)) {
			
			$missingModels = array();
			
			foreach ($models as $model) {
				foreach ($models as $model) {
					try {
						$q = new Doctrine_Query();
						$q->from($model)->count();
					} catch (Exception $e) {
						if (strpos($e->getMessage(), 'Base table or view not found') !== false)
							$missingModels[] = $model;
					}
					unset($e);
				}
			}
			
			if (!empty($missingModels))
				Doctrine::createTablesFromArray($missingModels);			
		}		
	}	
}
