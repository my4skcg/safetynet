<?php
//namespace mymvc;
//use logger as l;

define('SITEPATH', realpath(dirname(__FILE__)).'/');
define('HOST', $_SERVER['HTTP_HOST']);

$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
define('URI', $uri);

//echo '<pre>'.print_r($_SERVER['REQUEST_URI'],1).'</pre>';

require_once (SITEPATH . 'lib/appLogger.php');
//echo '<pre> Attempting to create appLogger </pre>';

$appLog = new appLogger(SITEPATH . 'logs', appLogger::DEBUG);
//echo '<pre> appLogger created </pre>';

$GLOBALS['appLog']->log('Using $GLOBALS[logger]', appLogger::DEBUG);
$GLOBALS['appLog']->log('SITEPATH = ' . SITEPATH, appLogger::DEBUG);
$GLOBALS['appLog']->log('HOST = ' . HOST, appLogger::DEBUG);
$GLOBALS['appLog']->log('URI = ' . URI, appLogger::DEBUG);

require (SITEPATH . 'lib/bootstrap.php');

new Bootstrap();

?>
