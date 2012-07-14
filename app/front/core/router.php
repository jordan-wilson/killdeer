<?php

class router
{

    private $registry;
    
    public function __construct()
    {   
        // load registry
        $this->registry = load_core('registry');
        
        // default controller -> action
        $this->registry->controller = DEFAULT_CONTROLLER;
        $this->registry->action = 'index';
        
        $this->_parse_url();
        $this->_parse_page();
        $this->_parse_modules();
    }
    
    
    // split url into an array
    private function _parse_url()
    {
        $input = load_core('input');
        
        $_args = array();
        if ($input->get('req') && trim($input->get('req')))
        {
            $request_parts = explode('/', $input->get('req'));
            for ($i = 0; $i < count($request_parts); $i++)
            {
                $_args[] = $request_parts[$i];
            }
        }
        $this->registry->request_args = count($_args) ? $_args : array('index');
    }
    
    
    // get the page info
    private function _parse_page()
    {
        $url = $this->registry->request_args[0];
        
        // get page info
        $pages_model = load_model('pages');
        $data = $pages_model->get_page_from_url($url);
        
        // if page not found
        if ( ! count($data))
        {
            // get error page
            $data = $pages_model->get_page_from_url('error');
            if ( ! count($data))
                error_page();
        }
            
        // update page data
        $this->registry->page_data = $data;
        
        // update the meta tags
        $this->registry->update_meta($data);
        
        
        // get page layout
        $layouts_model = load_model('layouts');
        //$layout = $layouts_model->get_layout($data['layout']);
        $layout = $layouts_model->get_layout_from_id($data['layout']);
        
        // if the layout is an array
        if (is_array($layout))
        {
            // update page layout (even if it's empty)
            $this->registry->page_layout = $layout;
        
            // update controller from layout
            if ($layout['controller'] != '')
                $this->registry->controller = $layout['controller'];
        }
        
    }
    
    
    // find all page urls with modules
    private function _parse_modules()
    {
        // match the layout template name with the page that is using it
        // the "layout.blogs.template.php" is being used by the "blog" page
        // since there is no actual database right now i can't really build this function
        // it'll store all the urls in the registry so anything can access them
        // ie: the blog block will first need to determine if there is a blog page
        // to link to - if not they don't return anything
        //$arr = array();
        //$arr['blogs'] = 'blog';
        //$this->registry->modules = $arr;
        
        $arr = array();
        
        // get list of unique controller layouts
        $layouts_model = load_model('layouts');
        $layouts = $layouts_model->get_controllers_list();
        if (count($layouts))
        {
            // get the url of pages with these layouts
            $pages_model = load_model('pages');
            foreach($layouts as $key => $val)
            {
                $page_url = $pages_model->get_page_url_from_layout($val);
                if ( ! empty($page_url))
                    $arr[$key] = $page_url;
            }
        }
        
        $this->registry->modules = $arr;
    }
    
    
    public function route()
    {
        // check for and load controller class
        $controller = load_controller($this->registry->controller);
        if ( ! $controller)
            error_page();
        
        // check for controller action
        $action = $this->registry->action;
        if ( ! method_exists($controller, $action))
            error_page();
        
        // run controller action
        $controller->$action();
    }

}