<?php

// START SESSIONS
session_start();

// APPLICATION SPECIFIC CONFIG SETTINGS
define('SITE_ROOT', dirname(__FILE__));
define('APP', 'admin');
define('URL_BASE', '/');
define('DEFAULT_CONTROLLER', 'dashboard');
define('DEFAULT_SKIN', 'default');
define('ERROR_CONTROLLER', 'error');
define('DEFAULT_HEADER_LAYOUT', 'default.header.layout.php');
define('DEFAULT_MAIN_LAYOUT', 'default.main.layout.php');
define('DEFAULT_FOOTER_LAYOUT', 'default.footer.layout.php');

// LOAD MAIN INIT FILE
include(SITE_ROOT . '/system/core/init.php');

// GO
$router->route();