<?php

class router
{

    private $registry;
    
    public function __construct()
    {   
        // LOAD REGISTRY
        $this->registry = load_core('registry');
        
        // TURN URL INTO CONTROLLER, ACTION, ARGS 
        $this->_parse_url();
    }
    
    
    private function _parse_url()
    {
        $input = load_core('input');
        
        
        // always uses default controller
        $this->registry->controller = DEFAULT_CONTROLLER;
        $this->registry->action = 'index';
        
        $_args = array();
        if ($input->get('req') && trim($input->get('req')))
        {
            $request_parts = explode('/', $input->get('req'));
            for ($i = 0; $i < count($request_parts); $i++)
            {
                $_args[] = $request_parts[$i];
            }
        }
        $this->registry->request_args = $_args;
        
    }
    
    private function _init_meta()
    {
        $title = ucwords(str_replace('_', ' ', $this->registry->controller));
        if ($this->registry->action != 'index')
        {
            $title .= ucwords(str_replace('_', ' ', $this->registry->action));
        }
        $this->registry->meta_title = $title;
        $this->registry->meta_keywords = '';
        $this->registry->meta_description = '';
    }
    
    public function route()
    {
        // LOAD CONTROLLER CLASS
        $controller = load_controller($this->registry->controller);
        if ( ! $controller)
            error_page();
        
        // RUN CONTROLLER ACTION
        $action = $this->registry->action;
        if ( ! method_exists($controller, $action))
            error_page();
            
        $controller->$action();
    }

}