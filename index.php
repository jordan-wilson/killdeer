<?php

// start sessions
session_start();

// application specific config settings
define('SITE_ROOT', dirname(__FILE__));
define('APP', 'front');
define('URL_BASE', '/');
define('ERROR_CONTROLLER', 'error');
define('DEFAULT_CONTROLLER', 'pages');
define('DEFAULT_ACTION', 'index');
define('DEFAULT_VIEW', 'default');
define('DEFAULT_SKIN', 'default');
define('DEFAULT_HEADER_TEMPLATE', 'pages.header.template.php');
define('DEFAULT_MAIN_TEMPLATE',   'pages.default.template.php');
define('DEFAULT_FOOTER_TEMPLATE', 'pages.footer.template.php');
define('DEBUGGERY', true);

// load app functions & overrides
$path = SITE_ROOT . '/app/' . APP . '/core/functions.php';
if (file_exists($path))
    include($path);

// load main init file
include(SITE_ROOT . '/system/core/init.php');

// go
$router->route();