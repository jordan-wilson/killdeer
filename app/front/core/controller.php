<?php

class controller
{
    
    protected $layout;
    
    public function __construct()
    {
        // get loaded classes and assign them to this object
        $_classes = is_loaded();
        foreach ($_classes as $class)
        {
            $this->$class = _load_class($class, '');
        }
        
        // set default main template
        $this->main_template = DEFAULT_MAIN_TEMPLATE;
    }
    
    
    // load blocks into each cell of layout
    public function parse_page_layout()
    {
        $layout = $this->registry->page_layout;
        
        if (count($layout))
        {
            // load block content into each cell of the layout
            foreach($layout['cells'] as $i => $cell)
            {
                foreach($cell as $j => $block)
                {
                    $html = '';
                    
                    // if regular page content
                    if ($block == '[content]')
                    {
                        $html = $this->registry->page_content;
                    }
                    
                    // else, try and look for modular content
                    else
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
                    
                    // update cell content
                    $layout['cells'][$i][$j] = $html;
                }
            }
        }
        
        $this->registry->page_layout = $layout;
    }
    
    
    public function display()
    {
        if ( ! isset($this->registry->page_layout))
        {
            exit('Layout not yet initialized');
        }
        else
        {
            $data = array('layout' => $this->registry->page_layout);
            echo load_view($this->main_template, $data);
        }
    }
}