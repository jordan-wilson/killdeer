<?php

//
// LOAD LIBRARY
// 
if ( ! function_exists('load_library'))
{
    function load_library($library_name)
    {
        // LOOK FOR APPLICATION LIBRARY FIRST
        $path_to_file = SITE_ROOT . '/app/' . APP . '/libraries/' . $library_name . '.php';
        if (file_exists($path_to_file))
            return _load_class($library_name, $path_to_file);
        
        // TRY SYSTEM LIBRARY
        $path_to_file = SITE_ROOT . '/system/libraries/' . $library_name . '.php';
        if (file_exists($path_to_file))
            return _load_class($library_name, $path_to_file);
        
        // LIBRARY CLASS DOESN'T EXIST
        return FALSE;
    }
}



// 
// LOAD HELPER
//
if ( ! function_exists('load_helper'))
{
    function load_helper($helper_name, $return_instance = FALSE)
    {
        // TRY APP HELPER
        $path = SITE_ROOT . '/app/' . APP . '/helpers/' . $helper_name . '.php';
        if (file_exists($path))
        {
            include_once($path);
            return $return_instance ? new $helper_name() : TRUE;
        }
        
        // TRY SYSTEM HELPER
        $path = SITE_ROOT . '/system/helpers/' . $helper_name . '.php';
        if (file_exists($path))
        {
            include_once($path);
            return $return_instance ? new $helper_name() : TRUE;
        }
        
        // NO HELPER FOUND
        return FALSE;
    }
}



//
// LOAD CONTROLLER
//
if ( ! function_exists('load_controller'))
{
    function load_controller($controller_name)
    {
        // TRY MY_MODULE CONTROLLER
        $path = SITE_ROOT . '/app/my_modules/' . $controller_name . '/' . APP . '/' . $controller_name . '.controller.php';
        if (file_exists($path))
            return _load_class($controller_name, $path);
        
        // TRY MODULE CONTROLLER 
        $path = SITE_ROOT . '/app/modules/' . $controller_name . '/' . APP . '/' . $controller_name . '.controller.php';
        if (file_exists($path))
            return _load_class($controller_name, $path);
        
        // TRY APPLICATION CONTROLLER
        $path = SITE_ROOT . '/app/' . APP . '/controllers/' . $controller_name . '.controller.php';
        if (file_exists($path))
            return _load_class($controller_name, $path);
        
        // TRY SYSTEM MODULE CONTROLLER
        $path = SITE_ROOT . '/app/modules/' . $controller_name . '/' . APP . '/' . $controller_name . '.controller.php';
        if (file_exists($path))
            return _load_class($controller_name, $path);
        
        // NO CONTROLLER FOUND
        return FALSE;
    }
}



//
// LOAD MODEL
//
if ( ! function_exists('load_model')) 
{
    function load_model($model_name)
    {
        // TRY MY_MODULE MODEL
        $path = SITE_ROOT . '/app/my_modules/' . $model_name . '/' . $model_name. '.model.php';
        if (file_exists($path)) 
            return _load_class($model_name . '_model', $path);
        
        // TRY APP MODULE MODEL
        $path = SITE_ROOT . '/app/modules/' . $model_name . '/' . $model_name . '.model.php';
        if (file_exists($path))
            return _load_class($model_name . '_model', $path);
        
        // TRY APP MODEL
        $path = SITE_ROOT . '/app/' . APP . '/models/' . $model_name . '.model.php';
        if (file_exists($path)) 
            return _load_class($model_name . '_model', $path);
        
        // NO MODEL FOUND
        return FALSE;
    }
}



//
// LOAD CORE CLASS
//
if ( ! function_exists('load_core'))
{
    function load_core($class_name)
    {   
        // SYSTEM CLASS
        $path = SITE_ROOT . '/system/core/' . $class_name . '.php';
        if (file_exists($path))
            return _load_class($class_name, $path);
        
        // APP CLASS
        $path = SITE_ROOT . '/app/' . APP . '/core/' . $class_name . '.php';
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
    function load_view($view, $vars = array())
    {
        // GET SKIN FROM REGISTRY
        $registry = load_core('registry');
        $skin = $registry->skin;
        
        // PARSE FILE NAME
        $_exploded_view = explode('.', $view);
        $module = $_exploded_view[0];
        
        // SKIN TEMPLATE
        $path = SITE_ROOT . '/skins/' . APP . '/' . $skin . '/' . $view;
        if (file_exists($path))
            return _return_view($path, $vars);
        
        // MY MODULE TEMPLATE
        $path = SITE_ROOT . '/app/my_modules/' . $module . '/' . APP . '/templates/' . $view;
        if (file_exists($path))
            return _return_view($path, $vars);
        
        // MODULE TEMPLATE
        $path = SITE_ROOT . '/app/modules/' . $module . '/' . APP . '/templates/' . $view;
        if (file_exists($path))
            return _return_view($path, $vars);
        
        // APP TEMPLATE
        $path = SITE_ROOT . '/app/' . APP . '/templates/' . $view;
        if (file_exists($path))
            return _return_view($path, $vars);
        
        // TRY MY MODULE TEMPLATE WITH A LONG PATH
        $path = SITE_ROOT . '/app/my_modules/' . $view;
        if (file_exists($path))
            return _return_view($path, $vars);
        
        // TRY MODULE TEMPLATE WITH A LONG PATH
        $path = SITE_ROOT . '/app/modules/' . $view;
        if (file_exists($path))
            return _return_view($path, $vars);
        
        return 'View not found: ' . $view;
    }
}



//
// RETURN CONTENTS OF TEMPLATE FILE
//
if ( ! function_exists('_return_view'))
{
    function _return_view($path, $vars)
    {
        extract($vars);
        $registry = load_core('registry');
        ob_start();
        include($path);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}


//
// LOAD CLASS INTO SYSTEM
//
if ( ! function_exists('_load_class'))
{
    function _load_class($class_name, $path)
    {
        static $_classes = array();
        
        // IF THE CLASS IS ALREADY LOADED, RETURN IT
        if (isset($_classes[$class_name]))
        {
            return $_classes[$class_name];
        }
        
        // OR LOAD AND SAVE
        if (file_exists($path))
        {
            include($path);
            $class = new $class_name();
            $_classes[$class_name] = $class;
            is_loaded($class_name);
            return $class;
        }
        
        // CLASS FILE DOESN'T EXIST
        return FALSE;
    }
}


//
// KEEPS TRACK OF WHICH CLASSES HAVE BEEN LOADED
//
if ( ! function_exists('is_loaded'))
{
    function is_loaded($class = false)
    {
        static $_is_loaded = array();
        
        if ($class)
            $_is_loaded[$class] = $class;
        
        return $_is_loaded;
    }
}


//
// TESTS IF THIS REQUEST IS ASYNCHRONOUS JAVASCRIPT REQUEST
//
if ( ! function_exists('is_ajax_request'))
{
    function is_ajax_request()
    {
        $input = load_core('input');
        
        if ($input->get('ajax') == 'true')
            return true;
            
        elseif ($input->post('ajax') == 'true')
            return true;
            
        else
            return $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }
}


//
// LOAD ERROR PAGE
//
if ( ! function_exists('error_page'))
{
    function error_page($type = 'page_not_found')
    {
        $error_controller = load_controller(ERROR_CONTROLLER);
        if ( ! $error_controller)
        {
            echo '<h3>Page not found</h3><p>Error page controller not set.</p>';
            exit;
        }
        
        if ($type == 'forbidden' OR $type == '403')
        {
            $error_controller->forbidden();
        }
        
        else 
        {
            $error_controller->page_not_found();
        }
        
        exit;
    }
}


//
// AUTO LOAD FOR CORE CLASSES
//
if ( ! function_exists('__autoload'))
{
    function __autoload($class_name) 
    {
        // APP CORE CLASS
        $path = SITE_ROOT . '/app/' . APP . '/core/' . $class_name . '.php';
        if (file_exists($path)) 
        {
            include_once($path);
            return TRUE;
        }
        
        // CORE SYSTEM CLASS
        $file_path = SITE_ROOT . '/system/core/' . $class_name . '.php';
        if (file_exists($file_path))
        {
            include_once($file_path);
            return TRUE;
        }
        
        return FALSE;
    }
}