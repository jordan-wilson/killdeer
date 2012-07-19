<?php

//
// OUTPUT READABLE ARRAY
//
if ( ! function_exists('printr'))
{
    function printr( $val )
    {
        if (is_array($val))
            return '<pre>' . print_r($val, true) . '</pre>';
        return $val;
    }
}



//
// PARSE CELL INTO STRING
//
if ( ! function_exists('parse_cell'))
{
    //function parse_cell( $layout = array(), $idx = 0, $content = false )
    function parse_cell( $idx = 0 )
    {
        $html = '<p>&nbsp;</p>';
        
        // get page layout from registry
        $registry = load_core('registry');
        $layout = $registry->page_layout;
        if ($layout['cells'])
        {
            // if layout contains cells data
            if ($layout['cells'])
            {
                if (count($layout['cells'][$idx]))
                {
                    $html = join('', $layout['cells'][$idx]);
                }
            }
        }
        
        return $html;
    }
}



//
// PARSE BLOCK FROM DATA STRING
//
if ( ! function_exists('parse_block'))
{
    function parse_block( $block = '' )
    {
        $html = '';
        
        if ( $block != '' )
        {
            // IF   $block   = '[forms:1]'
            // THEN $matches = array('[forms:1]', 'forms', '1')
            $matches = array();
            preg_match('/^\[(.*):(.*)\]$/', $block, $matches);
            if (count($matches) == 3)
            {
                $controller = load_controller($matches[1]);
                if ($controller)
                {
                    if (method_exists($controller, 'get_block'))
                    {
                        $html = $controller->get_block($matches[2]);
                    }
                }
            }
            
        }
        
        return $html;
    }
}



//
// PARSE PAGE CONTENT
//
if ( ! function_exists('parse_content'))
{
    function parse_content( $classname = 'page_content' )
    {
        $html = '';
        
        // get page content from registry
        $registry = load_core('registry');
        $content = $registry->page_data['content'];
        if ( $content != '' )
        {
            $html .= '<div class="' . $classname . '">';
                $html .= $content;
            $html .= '</div>';
        }
        
        return $html;
    }
}





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
        
        /*
        // "/skins/' templates directory
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
        */
        
        // "/skins/modules/" directory
        $path = SITE_ROOT . '/skins/' . APP . '/' . $skin . '/modules/' . $view;
        if (file_exists($path))
            return _return_view($path, $vars);
        
        // "/skins/modules/[controller]/" directory
        $path = SITE_ROOT . '/skins/' . APP . '/' . $skin . '/modules/' . preg_replace('/\./', '/', $view, 1);
        if (file_exists($path))
            return _return_view($path, $vars);
        
        // check for a default template to fallback on
        if ($default != '')
            return load_view($default, $vars);
        
        return 'View not found: ' . $view;
    }
}

