<?php

// START SESSIONS
session_start();

// APPLICATION SPECIFIC CONFIG SETTINGS
define('SITE_ROOT', dirname(__FILE__));
define('APP', 'front');
define('URL_BASE', '/');
define('DEFAULT_CONTROLLER', 'pages');
define('DEFAULT_SKIN', 'default');
define('ERROR_CONTROLLER', 'error');
define('DEFAULT_HEADER_TEMPLATE', 'header.layout.php');
define('DEFAULT_LAYOUT_TEMPLATE', 'pages.default.layout.php');
define('DEFAULT_FOOTER_TEMPLATE', 'footer.layout.php');

// LOAD APP FUNCTIONS & OVERRIDES
$path = SITE_ROOT . '/app/' . APP . '/core/functions.php';
if (file_exists($path))
    include($path);

// LOAD MAIN INIT FILE
include(SITE_ROOT . '/system/core/init.php');

// GO
$router->route();