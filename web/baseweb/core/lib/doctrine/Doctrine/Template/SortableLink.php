<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @created 2009-09-14
 */
class Doctrine_Template_SortableLink extends Doctrine_Template_Sortable
{
    protected $_options = array(
			'manyListsColumn' => null,
			'uniqueColumns' => array(),
	);

    public function setTableDefinition()
    {
        $this->hasColumn('position', 'integer');
        $this->addListener(new Doctrine_Template_Listener_Sortable());
    }

    public function getPrevious()
    {
        $many = $this->_options['manyListsColumn'];
		$unique = $this->_options['uniqueColumns'];

        $q = $this->getInvoker()->getTable()->createQuery()
            ->addWhere('position < ?', $this->getInvoker()->position)
            ->orderBy('position DESC');
		
		if (!empty($unique)) {			
			foreach ($unique as $column)
				$q->addWhere($column . ' = ?', $this->getInvoker()->$column);
		} else if (!empty($many)) {
            $q->addWhere($many . ' = ?', $this->getInvoker()->$many);
        }
		
        return $q->fetchOne();
    }

    public function getNext()
    {
        $many = $this->_options['manyListsColumn'];
		$unique = $this->_options['uniqueColumns'];

        $q = $this->getInvoker()->getTable()->createQuery()
            ->addWhere('position > ?', $this->getInvoker()->position)
            ->orderBy('position ASC');
			
		if (!empty($unique)) {			
			foreach ($unique as $column)
				$q->addWhere($column . ' = ?', $this->getInvoker()->$column);
		} else if (!empty($many)) {
            $q->addWhere($many . ' = ?', $this->getInvoker()->$many);
        }

        return $q->fetchOne();
    }

    public function swapWith(Doctrine_Record $record2)
    {
        $record1 = $this->getInvoker();

        $many = $this->_options['manyListsColumn'];
        if (!empty($many)) {
            if ($record1->$many != $record2->$many) {
                throw new Doctrine_Record_Exception('Cannot swap items from different lists.');
            }
        }

        $conn = $this->getTable()->getConnection();
        $conn->beginTransaction();

        $pos1 = $record1->position;
        $pos2 = $record2->position;
        $record1->position = $pos2;
        $record2->position = $pos1;
        $record1->save();
        $record2->save();

        $conn->commit();
    }

    public function moveUp()
    {
        $prev = $this->getInvoker()->getPrevious();
        if ($prev) {
            $this->getInvoker()->swapWith($prev);
        }
    }

    public function moveDown()
    {
        $next = $this->getInvoker()->getNext();
        if ($next) {
            $this->getInvoker()->swapWith($next);
        }
    }
}