<?php

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
