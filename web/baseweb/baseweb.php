<?php

/**
 * Base include file for baseweb. This is the only required file that the web
 * frontend needs to include or require.
 * 
 * NOTE: The order of the require statements is important.
 * 
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-05-13
 */
// Core functions, classes and interfaces
require ('core/core.php');

// Baseweb configuration
require ('settings/config.php');

// Baseweb autowired modules
require ('modules/modules.php');
