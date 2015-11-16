<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.1
 * @created 2009-09-26
 */
require ('../private.php');
require ('../../baseweb.php');

header('content-type: application/javascript');
echo 'var Baseweb = ' . json_encode(Baseweb::getSettings());
