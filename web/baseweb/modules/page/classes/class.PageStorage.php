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
 * @since 2.2
 * @created 2009-09-22
 */
final class PageStorage extends Baseweb_Storage {

	// PUBLIC METHODS

	public function getSlots() {

		$q = new Doctrine_Query();
		$q->from('Slot');
		return $q->execute();
	}

	public function getSlot($address, $name) {

		$q = new Doctrine_Query();
		$q->from('Slot s');
		$q->leftJoin('s.Article a');
		$q->where('s.address = ?', $address);
		$q->andWhere('s.name = ?', $name);

		return $q->fetchOne();
	}

	public function getSlotById($id) {

		$q = new Doctrine_Query();
		$q->from('Slot s');
		$q->leftJoin('s.Article a');
		$q->where('s.id = ?', intval($id));

		return $q->fetchOne();
	}

	public function addSlot($address, $name) {

		$s = new Slot();
		$s->address = $address;
		$s->name = $name;
		$a = new Article();
		$a->save();
		$s->article_id = $a->id;
		$s->save();

		return $s;
	}
}
