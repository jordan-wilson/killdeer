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
        
        return $val . '<br />';
    }
}



//
// PARSE LAYOUT CELL INTO STRING
//
if ( ! function_exists('parse_cell'))
{
    function parse_cell( $name = '' )
    {
        $html = '';
        
        // get page layout from registry
        $registry = load_core('registry');
        $layout = $registry->page_layout;
        
        // if there is cell data
        if (count($layout['cells']))
        {
            // if layout cell array exist
            $cell = $layout['cells'][$name];
            if (is_array($cell))
            {
                $cell = join('',  $cell);
                $html = (DEBUGGERY) ? debuggery('block', $arr = array('name' => $name, 'html' => $cell)) : $cell;
            }
        }
        
        return $html;
    }
}



//
// LOAD AND PARSE BLOCK
//
if ( ! function_exists('parse_block'))
{
    function parse_block( $block = array() )
    {
        $html = '';
        
        if (is_array($block))
        {
            $controller = load_controller($block['controller']);
            if ($controller)
            {
                if (method_exists($controller, 'get_block'))
                {
                    $html = $controller->get_block($block);
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
                $html .= (DEBUGGERY) ? debuggery('content') : '';
            $html .= '</div>';
        }
        
        return $html;
    }
}



//
// DEBUGGING
//
if ( ! function_exists('debuggery'))
{
    function debuggery( $case = '', $arr = array() )
    {
        if ( ! DEBUGGERY)
            return '';
        
        $html = '';
        
        switch ($case)
        {
            // add cell name on block rollover
            case 'block':
                $html .= '<div class="debuggery_block">';
                    $html .= $arr['html'];
                    $html .= '<div class="debuggery_block_name">';
                        $html .= 'cell: ' . $arr['name'];
                    $html .= '</div>';
                $html .= '</div>';
                break;
            
            // add template data to content block
            case 'content':
                $registry = load_core('registry');
                $layout = $registry->page_layout;
                $html .= '<div class="debuggery_content">';
                    $html .= '<table>';
                        $html .= '<tr>';
                            $html .= '<td>controller: </td>';
                            $html .= '<td>';
                                $html .= empty($layout['controller']) ? 'DEFAULT_CONTROLLER' : $layout['controller'];
                            $html .= '</td>';
                        $html .= '</tr>';
                        $html .= '<tr>';    
                            $html .= '<td>view: </td>';
                            $html .= '<td>';
                                $html .= empty($layout['view']) ? 'DEFAULT_VIEW' : $layout['view'];
                            $html .= '</td>';
                        $html .= '</tr>';
                        $html .= '<tr>';
                            $html .= '<td>template: </td>';
                            $html .= '<td>' . $layout['main_template'] . '</td>';
                        $html .= '</tr>';
                        $html .= '<tr>';
                            $html .= '<td>default template: </td>';
                            $html .= '<td>' . $layout['default_main_template'] . '</td>';
                        $html .= '</tr>';
                    $html .= '</table>';
                $html .= '</div>';
                break;
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
        // app class
        $path = SITE_ROOT . '/app/' . APP . '/core/' . $class_name . '.php';
        if (file_exists($path))
            return _load_class($class_name, $path);
        
        // system class
        $path = SITE_ROOT . '/system/core/' . $class_name . '.php';
        if (file_exists($path))
            return _load_class($class_name, $path);
        
        // core class not found
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
        
        // "/skins/blocks/" directory
        $path = SITE_ROOT . '/skins/' . APP . '/' . $skin . '/blocks/' . $view;
        if (file_exists($path))
            return _return_view($path, $vars);
        
        // "/skins/blocks/[controller]/" directory
        //$path = SITE_ROOT . '/skins/' . APP . '/' . $skin . '/blocks/' . preg_replace('/\./', '/', $view, 1);
        //if (file_exists($path))
            //return _return_view($path, $vars);
        
        // check for a default template to fallback on
        if ($default != '')
            return load_view($default, $vars);
        
        return 'View not found: ' . $view;
    }
}

