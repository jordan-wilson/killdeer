<?php

class blog extends controller 
{
    
    public function index( $data = array(), $caller = null )
    {
        $request = $this->registry->request_args;
        
        if ( count($request) == 1 )
        {
            $this->landing( $data, $caller );
        }
        else if ( count($request) == 2 )
        {
            $this->view( $request[1], $data, $caller );
        }
        else if ( $caller )
        {
            if (method_exists($caller, 'error_page'))
            {
                $caller->error_page();
            }
        }
        
    }
    
    
    private function css()
    {
        // add styles
        $css = '/skins/' . APP . '/' . DEFAULT_SKIN . '/css/blog.css';
        $this->registry->add_css_by_url($css);
    }
    
    
    private function landing( $data = array()  )
    {
        // get recent blogs
        $blog_model = load_model('blog');
        $data['blogs'] = $blog_model->get_landing();
        
        // add css
        $this->css();
        
        // display blog landing page
        echo load_view('header.template.php');
        echo load_view('blog.landing.template.php', $data);
        echo load_view('footer.template.php');
    }
    
    
    private function view( $url = '', $data = array(), $caller = null  )
    {
        // get blog info
        $blog_model = load_model('blog');
        $data['blog'] = $blog_model->get_view( $url );
        
        // blog not found
        if ( ! $data['blog'] && $caller )
        {
            if (method_exists($caller, 'error_page'))
            {
                $caller->error_page();
                return;
            }
        }
        
        // update meta
        if ( $caller )
        {
            if (method_exists($caller, 'update_meta'))
            {
                $data['blog'] = $caller->update_meta($data['blog']);
            }
        }
        
        // add css
        $this->css();
        
        // display blog post
        echo load_view('header.template.php');
        echo load_view('blog.view.template.php', $data);
        echo load_view('footer.template.php');
    }
    
    
}