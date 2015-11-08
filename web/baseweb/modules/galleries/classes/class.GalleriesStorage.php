<?php
/*
 * Copyright (c) Olle Törnström studiomediatech.com 2010
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
 * @created 2009-12-25
 */
final class GalleriesStorage extends Baseweb_Storage {
	
	// PUBLIC METHODS

	public function getGalleryCount($asMixed = false) {

		$q = new Doctrine_Query();
		
		$q->from('Gallery');
		
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
	
	public function getGalleries($page = 1, $limit = null, $asMixed = false) {
		
		$q = new Doctrine_Query();
		$q->from('Gallery');
		
		if (!$this->isAdmin)
			$q->where('status > ?', 0);
		
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
	
	public function getGallery($key = null) {
		
		$t = Doctrine::getTable('Gallery');
		
		if ($key && intval($key)) {
			return $t->find(intval($key));
		} else if ($key) {
			return $t->findOneBySlug(strval($key));
		}
		
		$q = new Doctrine_Query();
		$q->from('Gallery');
		$q->limit(1);
		
		return $q->execute()->get(0);
	}

	public function saveGallery($item) {		
		return $item->save();
	}
	
	public function deleteGallery($id) {
		
		$object = $this->getGallery($id);

		if ($item->delete())
			unset($item);
	}
}
