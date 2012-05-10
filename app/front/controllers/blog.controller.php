<?php

class blog extends controller 
{
    
    public function index( $data = array() )
    {
        $request = $this->registry->request_args;
        $this->page_controller = _load_class('page');
        
        // blog landing page
        if (count($request) == 1)
        {
            $this->landing($data);
            return;
        }
        // blog post
        else if (count($request) == 2)
        {
            $this->view($request[1], $data);
            return;
        }
        
        // show error page
        if ($this->page_controller)
        {
            if (method_exists($this->page_controller, 'error_page'))
            {
                $this->page_controller->error_page();
            }
        }
       
    }
    
    
    private function add_css()
    {
        $css = '/skins/' . APP . '/' . $this->registry->skin . '/css/blog.css';
        $this->registry->add_css_by_url($css);
    }
    
    
    private function landing( $data = array() )
    {
        // get recent blogs
        $blog_model = load_model('blog');
        $data['blogs'] = $blog_model->get_landing();
        
        // add css
        $this->add_css();
        
        // display blog landing page
        echo load_view('header.template.php');
        echo load_view('blog.landing.template.php', $data);
        echo load_view('footer.template.php');
    }
    
    
    private function view( $url = '', $data = array()  )
    {
        // get blog info
        $blog_model = load_model('blog');
        $data['blog'] = $blog_model->get_view($url);
        
        // blog not found
        if ( ! $data['blog'] && $this->page_controller)
        {
            if (method_exists($this->page_controller, 'error_page'))
            {
                $this->page_controller->error_page();
            }
        }
        
        // update meta
        if ($this->page_controller)
        {
            if (method_exists($this->page_controller, 'update_meta'))
            {
                $this->page_controller->update_meta($data['blog']);
            }
        }
        
        // add css
        $this->add_css();
        
        // display blog post
        echo load_view('header.template.php');
        echo load_view('blog.view.template.php', $data);
        echo load_view('footer.template.php');
    }
    
    
}