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
        //$this->main_template = DEFAULT_MAIN_TEMPLATE;
    }
    
    public function display()
    {
        if ( ! isset($this->registry->page_layout))
        {
            exit ('Layout not yet initialized');
        }
        else
        {
            $data = array('layout' => $this->registry->page_layout);
            echo load_view($this->registry->main_template, $data);
        }
    }
}