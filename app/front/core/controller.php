<?php

class controller
{
    
    var $_data = array();
    
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
                            $view = parse_block($block);
                            
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
        //$data = array('layout' => $this->registry->page_layout);
        //echo load_view($this->main_template, $data, $this->default_main_template);
        echo load_view($this->main_template, $this->_data, $this->default_main_template);
        
        // load footer
        echo load_view($this->footer_template);
    }
    
}