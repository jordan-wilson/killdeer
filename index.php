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
define('HTML_BLOCK_TEMPLATE', 'blocks.html.block.php');
define('DEFAULT_HEADER_TEMPLATE', 'pages.header.template.php');
define('DEFAULT_MAIN_TEMPLATE',   'pages.default.template.php');
define('DEFAULT_FOOTER_TEMPLATE', 'pages.footer.template.php');


// LOAD APP FUNCTIONS & OVERRIDES
$path = SITE_ROOT . '/app/' . APP . '/core/functions.php';
if (file_exists($path))
    include($path);

// LOAD MAIN INIT FILE
include(SITE_ROOT . '/system/core/init.php');

// GO
$router->route();