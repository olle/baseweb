<?php
require ('../../private/private.php');
require ('../../baseweb.php');
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
 * @since 2.x
 * @created 2009-07-03
 */
if ($_POST) {

	// TODO: Handle Ajax-post here.
	
} else {
	
	$action = isset($_GET['action']) ? strval($_GET['action']) : null;
	$jsonp = isset($_GET['jsonp']) ? strval($_GET['jsonp']) : null;
	
	if (!$action || $action == 'help') {

		echo Baseweb::getAdmin('tracking')->getHelp();
		return;
		
	} else if ($action == 'visitors') {

		$visitors = Baseweb::getAdmin('tracking')->pollVisitors();
		
		if (!$visitors)
			$data = array();
		else
			$data = $visitors->toArray();
		
		echo json_encode($data);
		return;
		
	} else if ($action == 'tracks') {
		
		$id = strval($_GET['id']);

		$visitor = Doctrine::getTable('Visitor')->find(intval($id));
		
		if (!$visitor) {
			echo '[]';
			return;
		}
		
		$tracks = Baseweb::getAdmin('tracking')->pollTracks($visitor);
		
		if (!$tracks)
			$data = array();
		else
			$data = $tracks->toArray();
		
		echo json_encode($data);
		return;
		
	} else if ($action == 'start') {
		
		$id = strval($_GET['id']);
		
		$visitor = Doctrine::getTable('Visitor')->find(intval($id));
		
		if (!$visitor) {
			echo 'false';
			return;			
		}
				
		Baseweb::getAdmin('tracking')->startTrackingVisitor($visitor);
		
		echo 'true';
		return;
		
	} else if ($action == 'stop') {
				
		$id = strval($_GET['id']);
		
		$visitor = Doctrine::getTable('Visitor')->find(intval($id));
		
		if (!$visitor) {
			echo 'false';
			return;
		}
		
		Baseweb::getAdmin('tracking')->stopTrackingVisitor($visitor);
		
		echo 'true';
		return;		
	}
}
?>