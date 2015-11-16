<?php

/**
 * @author Olle Törnström olle@studiomediatech.com
 * @since 2.0
 * @created 2009-05-13
 */
function config() {

	// SESSION-SETTINGS
	session_start();

	// CLEAN MAGIC QUOTES
	if (get_magic_quotes_gpc()) {
		$_GET = $_GET ? array_map('stripslashes', $_GET) : array();
		$_POST = $_POST ? array_map('stripslashes', $_POST) : array();
		$_COOKIE = $_COOKIE ? array_map('stripslashes', $_COOKIE) : array();
  }

	$config = parse_ini_file('config.ini', true);

	// CACHE SETTINGS

	Baseweb::getSettings()->CACHE_DIR = $config['cache']['dir'];
	Baseweb::getSettings()->CACHE_TIME = $config['cache']['time'];

	// APP-SETTINGS

	$language = $config['app']['language'];

	if (!empty($language)) {
		Baseweb::getSettings()->APP_LANGUAGE = $language;
	} else {
		Baseweb::getSettings()->APP_LANGUAGE = 'en';
	}

	// TODO: Make safe for extra tag eg. "-BETA".
	Baseweb::getSettings()->APP_VERSION = $config['app']['version'];
	$version = str_split(Baseweb::getSettings()->APP_VERSION);
	Baseweb::getSettings()->APP_VERSION_SAFE = join('', $version);
	Baseweb::getSettings()->APP_VERSION_MAJOR = $version[0];
	Baseweb::getSettings()->APP_VERSION_MINOR = $version[1];
	Baseweb::getSettings()->APP_VERSION_PATCH = $version[2];

	Baseweb::getSettings()->APP_DEBUG = $config['app']['debug'];

	if (Baseweb::getSettings()->APP_DEBUG == true) {
		Baseweb::getSettings()->CACHE_TIME = 0;
		error_reporting(E_ALL);
		require_once(dirname(__FILE__) . '/../core/lib/firephp/fb.php');
		ob_start();
	}

	$basedir = realpath(dirname(__FILE__) . '/../../');

	Baseweb::getSettings()->APP_BASEDIR = $basedir;
	Baseweb::getSettings()->APP_DATAPATH = !empty($config['content']['path']) ? $config['content']['path'] : '';
	$dir = $basedir . Baseweb::getSettings()->APP_DATAPATH;
	if (is_dir($dir))
		Baseweb::getSettings()->APP_DATADIR = substr($dir, -1) == '/' ? $dir : $dir . '/';
	else if (!empty(Baseweb::getSettings()->APP_DATAPATH))
		die("Could not find configured media directory:<br /><code>$dir</code>.<br />Please create it and ensure it's read and writeable by the webserver.");

	// WEB-SETTINGS

	$web = $config['web'];

	Baseweb::getSettings()->WEB_PROTOCOL = $web['protocol'];
	Baseweb::getSettings()->WEB_HOST = $web['host'];
	Baseweb::getSettings()->WEB_PORT = $web['port'];
	Baseweb::getSettings()->WEB_ADDRESS = ($web['protocol'] . $web['host'] . (isset($web['port']) ? ':' . $web['port'] : ''));

	// DB-SETTINGS

	$db = $config['db'];

	if (array_key_exists('USER', $_ENV)) {
		$user = $_ENV['USER'];

		if (isset($config['db-' . $user]))
			$db = $config['db-' . $user];
	}

	Baseweb::getSettings()->DB_TYPE = $db['type'];
	Baseweb::getSettings()->DB_HOST = $db['host'];
	Baseweb::getSettings()->DB_USER = $db['user'];
	Baseweb::getSettings()->DB_PASSWORD = $db['password'];
	Baseweb::getSettings()->DB_NAME = $db['name'];
	Baseweb::getSettings()->DB_PREFIX = $db['prefix'];
	Baseweb::getSettings()->DB_CHARSET = $db['charset'];
	Baseweb::getSettings()->DB_COLLATE = $db['collate'];

	// Doctrine

	Doctrine_Manager::getInstance()->setCharset(Baseweb::getSettings()->DB_CHARSET);
	Doctrine_Manager::getInstance()->setCollate(Baseweb::getSettings()->DB_COLLATE);

	Doctrine_Manager::getInstance()->setAttribute(Doctrine::ATTR_TBLNAME_FORMAT, Baseweb::getSettings()->DB_PREFIX . '%s');
	Doctrine_Manager::getInstance()->setAttribute(Doctrine::ATTR_QUOTE_IDENTIFIER, true);
	Doctrine_Manager::getInstance()->setAttribute(Doctrine::ATTR_DEFAULT_TABLE_CHARSET, Baseweb::getSettings()->DB_CHARSET);
	Doctrine_Manager::getInstance()->setAttribute(Doctrine::ATTR_VALIDATE, Doctrine::VALIDATE_CONSTRAINTS);

	Doctrine::debug(Baseweb::getSettings()->APP_DEBUG);

	$dsn = sprintf('%s://%s:%s@%s/%s?charset=%s',
		Baseweb::getSettings()->DB_TYPE,
		Baseweb::getSettings()->DB_USER,
		Baseweb::getSettings()->DB_PASSWORD,
		Baseweb::getSettings()->DB_HOST,
		Baseweb::getSettings()->DB_NAME,
		Baseweb::getSettings()->DB_CHARSET);

	$conn = Doctrine_Manager::connection($dsn, Baseweb::getSettings()->DB_NAME);
	$conn->setCharset(Baseweb::getSettings()->DB_CHARSET);
	$conn->setCollate(Baseweb::getSettings()->DB_COLLATE);
	Baseweb::setConnection($conn);

	// MAIL-SETTINGS

	$mail = $config['mail'];

	if (isset($user)) {
		if (isset($config['mail-' . $user]))
			$mail = $config['mail-' . $user];
	}

	Baseweb::getSettings()->MAIL_SENDER = $mail['sender'];
	Baseweb::getSettings()->MAIL_RECEIVER = $mail['receiver'];
}

config();
