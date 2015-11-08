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
 * @since 2.0
 * @created 2009-06-19
 */
interface Servable {
	
	/**
	 * Must ensure to process the current POST request sent by the browser.
	 * @return the results for further handling.
	 * @param object $result[optional]
	 */
	public function doPost(Baseweb_Result $result = null);	
	
	/**
	 * Must ensure to process the current GET reqeust sent by the browser.
	 * @return the results for further handling.
	 * @param object $result[optional]
	 */
	public function doGet(Baseweb_Result $result = null);
}
