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
// LOAD VIEW
//
if ( ! function_exists('load_view'))
{
    function load_view($view, $vars = array(), $default = '')
    {
        // get skin from registry
        $registry = load_core('registry');
        $skin = $registry->skin;
        
        // skins directory
        $path = SITE_ROOT . '/skins/' . APP . '/' . $skin . '/' . $view;
        if (file_exists($path))
            return _return_view($path, $vars);
        
        // skins templates directory
        $path = SITE_ROOT . '/skins/' . APP . '/' . $skin . '/templates/' . $view;
        if (file_exists($path))
            return _return_view($path, $vars);
            
        // skins templates modules directory
        $path = SITE_ROOT . '/skins/' . APP . '/' . $skin . '/templates/' . preg_replace('/\./', '/', $view, 1);
        if (file_exists($path))
            return _return_view($path, $vars);
        
        // app templates
        $path = SITE_ROOT . '/app/' . APP . '/templates/' . $view;
        if (file_exists($path))
            return _return_view($path, $vars);
        
        
        // check for a default template to fallback on
        if ($default != '')
            return load_view($default, $vars);
        
        return 'View not found: ' . $view;
    }
}

