<?php

//
// LOAD CORE CLASS
//
if ( ! function_exists('load_core'))
{
    function load_core($class_name)
    {        
        // APP CLASS
        $path = SITE_ROOT . '/app/' . APP . '/core/' . $class_name . '.php';
        if (file_exists($path))
            return _load_class($class_name, $path);
        
        // SYSTEM CLASS
        $path = SITE_ROOT . '/system/core/' . $class_name . '.php';
        if (file_exists($path))
            return _load_class($class_name, $path);
        
        // CORE CLASS NOT FOUND
        return FALSE;
    }
}