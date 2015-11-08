<?php
/*
 * Copyright (c) Olle Törnström studiomediatech.com 2009
 *
 * THIS CODE IS PROPRIETARY AND PROTECTED BY COPYRIGHT LAW AGAINST COPYING,
 * RE-DISTRIBUTION, PUBLISHING OR DE-COMPILATION WITHOUT THE PRIOR WRITTEN
 * CONSENT OF THE AUTHOR. USAGE IS CONTROLLED BY A LICENSE AGREEMENT,
 * REGULATING THE SPECIFIC, UNIQUE, NON EXCLUSIVE RIGHTS TO RUN, USE OR
 * INCLUDE THE CODE IN WHOLE, PART, COMPILED OR DECOMPILED FORM.
 */
/**
 * Base include file for baseweb. This is the only required file that the web
 * frontend needs to include or require.
 * 
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-05-18
 */
// INTERFACES
require ('interfaces/interface.Module.php');
require ('interfaces/interface.Installable.php');
require ('interfaces/interface.Administratable.php');
require ('interfaces/interface.HelpEnabled.php');
require ('interfaces/interface.Ajaxable.php');
require ('interfaces/interface.Servable.php');
require ('interfaces/interface.Storage.php');
require ('interfaces/interface.Updatable.php');

// CLASSES
require ('classes/class.Baseweb.php');
require ('classes/class.Baseweb_Module.php');
require ('classes/class.Baseweb_AdminModule.php');
require ('classes/class.Baseweb_Cache.php');
require ('classes/class.Baseweb_Storage.php');
require ('classes/class.Baseweb_HtmlUtils.php');
require ('classes/class.Baseweb_FileFilter.php');
require ('classes/class.Baseweb_FileUtils.php');
require ('classes/class.Baseweb_ImageUtils.php');
require ('classes/class.Baseweb_Result.php');
require ('classes/class.Baseweb_Params.php');

// LIBRARIES
require ('lib/doctrine/bootstrap.php');
