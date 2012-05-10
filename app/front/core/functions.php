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


//
// LOAD CLASS INTO SYSTEM
//
if ( ! function_exists('_load_class'))
{
    function _load_class($class_name, $path = null)
    {
        static $_classes = array();
        
        // IF THE CLASS IS ALREADY LOADED, RETURN IT
        if (isset($_classes[$class_name]))
        {
            return $_classes[$class_name];
        }
        
        // OR LOAD AND SAVE
        if ($path)
        {
            if (file_exists($path))
            {
                include($path);
                $class = new $class_name();
                $_classes[$class_name] = $class;
                is_loaded($class_name);
                return $class;
            }
        }
        
        // CLASS FILE DOESN'T EXIST
        return FALSE;
    }
}

