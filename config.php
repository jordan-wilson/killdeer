<?php 

if ( ! defined('APP')) exit; 

// SET TIMEZONE
date_default_timezone_set('America/New_York');

// DATABASE SETTINGS
define('DB_HOST', '');
define('DB_USER', '');
define('DB_PASS', '');
define('DB_NAME', '');

// IMAGE SETTINGS
define('IMG_MAX_WIDTH', 1090);
define('IMG_MAX_HEIGHT', 700);
define('IMG_DEFAULT_THUMB_HEIGHT', 100);
define('IMG_DEFAULT_THUMB_WIDTH', 100);
define('IMG_DEFAULT_CURRENT_HEIGHT', 300);
define('IMG_DEFAULT_CURRENT_WIDTH', 400);