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
        
        // ADD DEFAULT VALUES FOR PAGE META INFO
        $this->_init_meta();
    }
    
    
private function _parse_url()
    {
        $input = load_core('input');
        
        if ($input->get('req') && trim($input->get('req')))
        {
            $request_parts = explode('/', $input->get('req'));
            
            // CONTROLLER
            $this->registry->controller = $request_parts[0] ? $request_parts[0] : DEFAULT_CONTROLLER;
            
            // ACTION
            $this->registry->action = $request_parts[1] ? $request_parts[1] : 'index';
            
            // ARGS
            $_args = array();
            for ($i=2; $i<count($request_parts); $i++)
            {
                $_args[] = $request_parts[$i];
            }
            $this->registry->request_args = $_args;
        }
        
        else
        {
            $this->registry->controller = DEFAULT_CONTROLLER;
            $this->registry->action = 'index';
            $this->registry->request_args = array();
        }
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