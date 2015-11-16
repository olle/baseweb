<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-05-13
 */
require ('../baseweb.php');
require ('./private.php');

if (Baseweb::hasModule('admin'))
	header('Location: ./admin/');
else
	header('Location:' . WEB_ADDRESS);
