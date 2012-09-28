<?php

define('DEVELOPMENT_ENVIRONMENT', true);
define('HOST', $_SERVER['HTTP_HOST']);

$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
define('URI', $uri);

define('DEVELOPMENT_ENVIRONMENT', true);

// database table names
define('USERS_TABLE', 'users');
?>
