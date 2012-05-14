<?php

class controller
{
    
    protected $content;
    protected $layout;
    
    public function __construct()
    {
        // GET LOADED CLASSES AND ASSIGN THEM TO THIS OBJECT
        $_classes = is_loaded();
        foreach ($_classes as $class)
        {
            $this->$class = _load_class($class, '');
        }
        
        // SET DEFAULT MAIN TEMPLATE
        $this->main_template = DEFAULT_MAIN_TEMPLATE;
    }
    
    public function display()
    {
        // VIEW HASN'T BEEN ASSIGNED YET
        /*
        if ( ! isset($this->content))
        {
            exit ('Content not loaded');
        }
        
        // OUTPUT CONTENTS OF VIEW
        else
        {
            $data = array(
                'content' => $this->content,
                'layout' =>  $this->layout
            );
            echo load_view($this->main_template, $data);
        }
        */
        
        if ( ! isset($this->layout))
        {
            exit ('Layout not yet initialized');
        }
        else
        {
            $data = array('layout' => $this->layout);
            echo load_view($this->main_template, $data);
        }
        
    }
}