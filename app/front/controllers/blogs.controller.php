<?php

class blogs extends controller 
{

    public function layout()
    {
        $request = $this->registry->request_args;
        
        // blog landing page
        if (count($request) == 1)
        {
            $this->index();
        }
        
        // individual blog post
        elseif (count($request) == 2)
        {
            $this->view( $request[1] );
        }
        
    }
    
    
    // blogs landing page
    private function index()
    {
        // load main template
        $template = 'layout.blogs.template.php';
        $path = SITE_ROOT . '/skins/' . APP . '/' . $this->registry->skin . '/' . $template;
        if (file_exists($path))
            $this->registry->main_template = $template;
        
        
        // get page data
        $data = $this->registry->page_data;
                
        // get recent blogs
        $blogs_model = load_model('blogs');
        $data['blogs'] = $blogs_model->get_landing();
        
        // add css
        $this->add_css();
        
        // replace page content
        $this->registry->page_content = load_view('blogs.landing.template.php', $data);
    }
    
    
    // individual blog post
    private function view( $url = ''  )
    {
        // load main template
        $template = 'layout.blogs.template.php';
        $path = SITE_ROOT . '/skins/' . APP . '/' . $this->registry->skin . '/' . $template;
        if (file_exists($path))
            $this->registry->main_template = $template;
        
        
        // get page data
        $data = $this->registry->page_data;
        
        // get blog info
        $blogs_model = load_model('blogs');
        $data['blog'] = $blogs_model->get_view($url);
        
        // if blog not found
        /*if ( ! $data['blog'])
        {
            if (method_exists($this->pages, 'error_page'))
            {
                $this->pages->error_page();
            }
        }*/
                
        // update meta
        /*if (method_exists($this->pages, 'update_meta'))
        {
            $this->pages->update_meta($data['blog']);
        }*/
        
        // add css
        $this->add_css();
        
        
        // replace page layout
        $layouts_model = load_model('layouts');
        $layout = $layouts_model->get_layout($data['blog']['layout']);
        if (count($layout))
            $this->registry->page_layout = $layout;
        
        
        // replace page content
        $this->registry->page_content = load_view('blogs.view.template.php', $data);
    }
    
    
    private function add_css()
    {
        $css = '/skins/' . APP . '/' . $this->registry->skin . '/css/blogs.css';
        $this->registry->add_css_by_url($css);
    }
    
    
    public function get_block( $arg = '' )
    {
        // blog content
        if ( $arg == 'content' )
        {
            $request = $this->registry->request_args;
            
            // blog landing page
            if (count($request) == 1)
            {
                return $this->index();
            }
            
            // blog post
            elseif (count($request) == 2)
            {
                return $this->view( $request[1] );
            }
            
            // to many arguments in the url
            elseif ($this->pages)
            {
                if (method_exists($this->pages, 'error_page'))
                {
                    $this->pages->error_page();
                }
            }
        }
        
        // individual blog block
        //elseif (is_numeric($arg))
        if (is_numeric($arg))
        {
            return $this->get_blog_block($arg);
        }
        
        // subscribe block
        elseif ($arg == 'subscribe.block')
        {
            return $this->get_subscribe_block();
        }
        
        // recent blog post block
        elseif ($arg == 'recent.block')
        {
            return $this->get_recent_block();
        }
        
        // blog categories block
        elseif ($arg == 'categories.block')
        {
            return $this->get_categories_block();
        }
        
        return '';
    }
    
    
    // individual blog block
    private function get_blog_block( $id = 0 )
    {
        if ( ! $this->registry->modules['blogs']) return '';
        
        // get blog info
        $blogs_model = load_model('blogs');
        $data['blog'] = $blogs_model->get_blog($id);
        $data['link'] = '/' . $this->registry->modules['blogs'] . '/';
        
        // if blog not found
        if ( ! $data['blog']) return '';
        
        // add css
        $this->add_css();
        
        // load blog post
        return load_view('blogs.blog.block.template.php', $data);
    }
    
    
    // subscribe block
    private function get_subscribe_block()
    {
        if ( ! $this->registry->modules['blogs']) return '';
        $data['link'] = '/' . $this->registry->modules['blogs'] . '/';
        
        // load blog subscribe block
        return load_view('blogs.subscribe.block.template.php', $data);
    }
    
    
    // categories block
    private function get_categories_block()
    {
        if ( ! $this->registry->modules['blogs']) return '';
        $data['link'] = '/' . $this->registry->modules['blogs'] . '/';
        
        // load blog categories block
        return load_view('blogs.categories.block.template.php', $data);
    }
    
    
    // recent blog post block
    private function get_recent_block()
    {
        if ( ! $this->registry->modules['blogs']) return '';
        $data['link'] = '/' . $this->registry->modules['blogs'] . '/';
        
        // load recent blog post block
        return load_view('blogs.recent.block.template.php', $data);
    }
    
    
}