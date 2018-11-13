<?php

session_start();

/**
 * Settings file created to automatically toggle between development and production phase
 * and to define global variable for database, session and cookies 
 */

$serverName = $_SERVER['SERVER_NAME'];
$serverPort = $_SERVER['SERVER_PORT'];

define('VIRTUALHOST', 'virtualhost.name');

if($serverName == 'localhost' || $serverName == 'VIRTUALHOST') {
	define('ENVIRONMENT', 'development');
} else {
	define('ENVIRONMENT', 'production');
}

switch(ENVIRONMENT) {
	case 'development':
		ini_set('display_errors', 'on');
		ini_set('allow_url_fopen',1);
		error_reporting(-1);
		define('HTTP', 'http://' . $serverName . ':' . $_SERVER['SERVER_PORT'] . '/');
		define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/beta/');
		define('ASSET', HTTP . 'beta/public_html/');
		define('URL', 'http://' . $serverName . ':' . $_SERVER['SERVER_PORT'] . '/beta/');

	break;

	case 'production':
		define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/beta/');
		define('HTTP', 'http://' . $serverName . '/');
		define('URL', 'http://' . $serverName . '/beta/');
		define('ASSET', HTTP. '/beta/public_html/');
		ini_set('display_errors', 'on');
		error_reporting(-1);
	break;

	default:
		die('Unknown Place');
}

$GLOBALS['CONFIG'] = array(
	'database' => array(
		'host' => '127.0.0.1',
		'username' => 'root',
		'password' => 'Met@llica2',
		'dbname' => 'bijenska_photographers_diary',
	),
	'remember' => array(
		'cookie_name' => 'hash',
		'cookie_expiry' => 604800,
	),
	'session' => array(
		'session_name' => 'user',
		'token_name' => 'csrf_token'
	),
);


$GLOBALS['restrictedPages']=['user-list','add-user','update-user'];

function autoload($className)
{
	$userLibPath = ROOT . 'user/lib/' . $className . '.php';
	$lib = ROOT . 'lib/' . $className . '.php';
    $libPath = ROOT . 'admin/lib/' . $className . '.php';
    $configPath = ROOT . 'classes/' . $className . '.php';
    $modelPath= ROOT . 'classes/Model/'.$className.'.php';
    if (file_exists($libPath) && is_file($libPath)) {
        require_once($libPath);
    } elseif (file_exists($userLibPath) && is_file($userLibPath)) {
    	require_once($userLibPath);
    } elseif (file_exists($configPath) && is_file($configPath)) {
        require_once($configPath);
    }elseif (file_exists($modelPath) && is_file($modelPath)){
        require_once ($modelPath);
    }elseif (file_exists($lib) && is_file($lib)){
        require_once ($lib);
    } else {
        die("$className not found!!!!");
    }
}
spl_autoload_register('autoload');
require_once (ROOT.'helper/functions.php');
require_once (ROOT.'helper/helper.php');