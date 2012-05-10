<?php

class blog extends controller 
{
    
    public function index( $data = array() )
    {
        if ( ! $this->page) return;
        
        $request = $this->registry->request_args;
        
        // blog landing page
        if (count($request) == 1)
        {
            $this->landing($data);
            return;
        }
        // blog post
        elseif (count($request) == 2)
        {
            $this->view($request[1], $data);
            return;
        }
        
        // show error page
        if (method_exists($this->page, 'error_page'))
        {
            $this->page->error_page();
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
        
        // load landing page
        $this->page->content = load_view('blog.landing.template.php', $data);
    }
    
    
    private function view( $url = '', $data = array()  )
    {
        // get blog info
        $blog_model = load_model('blog');
        $data['blog'] = $blog_model->get_view($url);
        
        // blog not found
        if ( ! $data['blog'])
        {
            if (method_exists($this->page, 'error_page'))
            {
                $this->page->error_page();
            }
        }
        
        // update meta
        if (method_exists($this->page, 'update_meta'))
        {
            $this->page->update_meta($data['blog']);
        }
        
        // add css
        $this->add_css();
        
        // load blog post
        $this->page->content = load_view('blog.view.template.php', $data);
    }
    
    
}