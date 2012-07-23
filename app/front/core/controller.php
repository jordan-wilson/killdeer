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
    
    
    // update layout and load blocks
    public function parse_page_layout()
    {
        $layout = $this->registry->page_layout;
        
        if (count($layout))
        {
            // build the layout template
            $layout_controller = ($layout['controller'] == '') ? DEFAULT_CONTROLLER : $layout['controller'];
            $layout_view       = ($layout['view'] == '') ? DEFAULT_VIEW : $layout['view'];
            $main_template     = $layout_controller . '.' . $layout_view . '.template.php';
            
            // update layout template
            $this->main_template             = $main_template;
            $this->default_main_template     = DEFAULT_MAIN_TEMPLATE;
            $layout['main_template']         = $main_template;
            $layout['default_main_template'] = DEFAULT_MAIN_TEMPLATE;
            
            // check for cells data
            if (is_array($layout['cells']))
            {
                // loop through array of blocks
                foreach($layout['cells'] as $key => $blocks)
                {
                    // parse and replace each block with the actual html
                    foreach($blocks as $idx => $block)
                    {
                        $parse = parse_block($block);
                        $layout['cells'][$key][$idx] = $parse;
                    }
                }
            }
            
        }
        
        $this->registry->page_layout = $layout;
    }
    
    
    // output the page
    public function display()
    {
        // parse page layout
        $this->parse_page_layout();
        
        // load header
        echo load_view($this->header_template);
        
        // load layout (with a default fallback)
        echo load_view($this->main_template, $this->_data, $this->default_main_template);
        
        // load footer
        echo load_view($this->footer_template);
    }
    
}