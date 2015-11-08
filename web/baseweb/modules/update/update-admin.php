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

