<?php

class controller
{
    
    public function __construct()
    {
        // get loaded classes and assign them to this object
        $_classes = is_loaded();
        foreach ($_classes as $class)
        {
            $this->$class = _load_class($class, '');
        }
        
        // set default main template
        $this->header_template = DEFAULT_HEADER_TEMPLATE;
        $this->main_template   = DEFAULT_MAIN_TEMPLATE;
        $this->footer_template = DEFAULT_FOOTER_TEMPLATE;
        
        // used as a fallback if custom layout isn't found
        $this->default_main_template = '';
    }
    
    
    // load blocks into each cell of layout
    public function parse_page_layout()
    {
        $layout = $this->registry->page_layout;
        
        if (count($layout))
        {
            // update layout template
            $layout_controller = ($layout['controller'] == '') ? DEFAULT_CONTROLLER : $layout['controller'];
            $layout_skin       = ($layout['skin'] == '') ? 'default' : $layout['skin'];
            $main_template     = $layout_controller . '.' . $layout_skin . '.template.php';
            
            $this->main_template         = $main_template;
            $this->default_main_template = DEFAULT_MAIN_TEMPLATE;
            
            // if there is cell data
            if ( ! empty($layout['cells']))
            {
                $layout['cells'] = json_decode($layout['cells']);
                array_unshift($layout['cells'], array());
            
                // load block content into each cell of the layout
                if (is_array($layout['cells']))
                {
                    foreach($layout['cells'] as $i => $cell)
                    {
                        foreach($cell as $j => $block)
                        {
                            $view = '';
                            
                            // if regular page content
                            if ($block == '[content]')
                            {
                                $view = $this->registry->page_content;
                            }
                            
                            // else, try and load modular content
                            else
                            {
                                /*
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
                                            $view = $controller->get_block($matches[2]);
                                        }
                                    }
                                }
                                */
                                //$view = $this->parse_block_layout($block);
                                $view = parse_block($block);
                            }
                            
                            // if view is still blank then it's an html block
                            if ($view == '')
                            {
                                $data = array('content' => $block);
                                $view = load_view(HTML_BLOCK_TEMPLATE, $data);
                            }
                            
                            // update cell's block content
                            $layout['cells'][$i][$j] = $view;
                        }
                    }
                }
                
            }
        }
        
        $this->registry->page_layout = $layout;
    }
    
    
    public function display()
    {
        // parse page layout
        $this->parse_page_layout();
        
        // load header
        echo load_view($this->header_template);
        
        // load layout (with default fallback)
        $data = array('layout' => $this->registry->page_layout);
        echo load_view($this->main_template, $data, $this->default_main_template);
        
        // load footer
        echo load_view($this->footer_template);
    }
    
}