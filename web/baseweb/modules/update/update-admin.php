<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.1
 * @created 2009-09-25
 */
require ('classes/class.UpdateAdmin.php');
require ('classes/class.BaseUpdateVersion.php');
require ('classes/class.UpdateVersion.php');
require ('classes/class.BaseUpdateModule.php');
require ('classes/class.UpdateModule.php');
require ('classes/class.BaseUpdateModules.php');
require ('classes/class.UpdateModules.php');

// Wired for update even when Install is disabled.
require_once (dirname(__FILE__) . '/../install/classes/class.InstallAdmin.php');
require_once (dirname(__FILE__) . '/../install/classes/class.BaseInstallation.php');
require_once (dirname(__FILE__) . '/../install/classes/class.Installation.php');
require_once (dirname(__FILE__) . '/../install/classes/class.InstallStorage.php');

