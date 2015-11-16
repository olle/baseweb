<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-06-21
 */
final class NewsStorage extends Baseweb_Storage {
	
	// PUBLIC METHODS

	public function getNewsCount($asMixed = false) {

		$q = new Doctrine_Query();
		
		$q->from('Newsitem');
		
		if (!$this->isAdmin) {
			$q->where('status > ?', 0);
			return $q->count();
		}

		if ($asMixed) {
			return array(
				'total' => $total = $q->count(),
				'active' => $active = $q->where('status > ?', 0)->count(),
				'inactive' => $total - $active
			);
		}
		
		return $q->count();
	}
	
	public function getNewslist($page = 1, $limit = null, $asMixed = false) {
		
		$q = new Doctrine_Query();
		$q->from('Newsitem');
		
		if (!$this->isAdmin)
			$q->where('status > ?', 0);
			
		$q->orderBy('created_at DESC');
		
		$p = new Doctrine_Pager($q, $page, $limit);
		
		if ($asMixed) {
			return new Baseweb_Result(array(
				'items' => $p->execute(),
				'pager' => $p
			));
		} else {
			return $p->execute();
		}
	}
	
	public function getNewsitem($key = null) {
		
		$t = Doctrine::getTable('Newsitem');
		
		if ($key && intval($key)) {
			return $t->find(intval($key));
		} else if ($key) {
			return $t->findOneBySlug(strval($key));
		}
		
		$q = new Doctrine_Query();
		$q->from('Newsitem');
		$q->limit(1);
		
		return $q->execute()->get(0);
	}

	public function saveNewsitem($item) {		
		return $item->save();
	}
	
	public function deleteNewsitem($id) {
		
		$object = $this->getNewsitem($id);

		if ($item->delete())
			unset($item);
	}
}
