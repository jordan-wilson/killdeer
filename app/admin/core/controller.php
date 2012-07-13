<?php

class controller
{
    
    protected $content;
    
    public function __construct()
    {
        // GET LOADED CLASSES AND ASSIGN THEM TO THIS OBJECT
        $_classes = is_loaded();
        foreach ($_classes as $class)
        {
            $this->$class = _load_class($class, '');
        }
        
        // SET DEFAULT MAIN TEMPLATE
        $this->header_layout = DEFAULT_HEADER_LAYOUT;
        $this->main_layout   = DEFAULT_MAIN_LAYOUT;
        $this->footer_layout = DEFAULT_FOOTER_LAYOUT;
    }
    
    public function display()
    {
        // VIEW HASN'T BEEN ASSIGNED YET
        if ( ! isset($this->content))
            exit ('Content not loaded');
        
        // OUTPUT CONTENTS OF VIEW
        else
        {
            // load the header layout
            echo load_view($this->header_layout);
            
            // load the main layout
            $data = array('content' => $this->content);
            echo load_view($this->main_layout, $data);
            
            // load the footer layout
            echo load_view($this->footer_layout);
        }
    }
    
}