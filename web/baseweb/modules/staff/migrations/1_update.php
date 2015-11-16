<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.1
 * @created 2009-09-25
 */
class Update extends Doctrine_Migration_Base {

	public function up() {
		$this->addColumn('employee', 'image', 'string', array(
				'notnull' => true,
				'default' => '',
		));
		$this->addColumn('employee', 'position', 'integer');
	}
	
	public function postUp() {
		$q = new Doctrine_Query();
		$q->update('Employee');
		$q->set('position', 'id');
		$q->execute();
	}
	
	public function down() {
		$this->removeColumn('employee', 'image');
		$this->removeColumn('employee', 'position');
	}
}