<?php

class blogs extends controller 
{
    
    public function index()
    {
        // update main template
        $this->main_template = 'layout.blogs.template.php';
        
        // update page content
        $request = $this->registry->request_args;
        if (count($request) == 1)
        {
            // landing page
            $this->registry->page_content = $this->_index();
        }
        elseif (count($request) == 2)
        {
            // individual blog post
            $this->registry->page_content = $this->_view($request[1]);
        }
        else {
            header('Location: /error');
            exit();
        }
        
        // parse page layout
        $this->parse_page_layout();
        
        // output the page
        $this->display();
    }
    
    
    // blogs landing page
    private function _index()
    {
        // get recent blogs
        $blogs_model = load_model('blogs');
        $data['blogs'] = $blogs_model->get_landing();
        
        // add css
        $this->_add_css();
        
        // return html
        return load_view('blogs.landing.template.php', $data);
    }
    
    
    // individual blog post
    private function _view( $url = ''  )
    {
        // get blog data
        $blogs_model = load_model('blogs');
        $data['blog'] = $blogs_model->get_view($url);
        
        // if blog not found
        if ( ! $data['blog'])
        {
            header('Location: /error');
            exit();
        }
        
        // update meta tags
        $this->registry->update_meta($data['blog']);
        
        // get blog layout
        $layouts_model = load_model('layouts');
        $layout = $layouts_model->get_layout($data['blog']['layout']);
        
        // update page layout
        if (count($layout))
            $this->registry->page_layout = $layout;
        
        // add css
        $this->_add_css();
        
        // return html
        return load_view('blogs.view.template.php', $data);
    }
    
    
    private function _add_css()
    {
        $css = '/skins/' . APP . '/' . $this->registry->skin . '/css/blogs.css';
        $this->registry->add_css_by_url($css);
    }
    
    
    public function get_block( $arg = '' )
    {
        // check if the blogs module is on a page
        if ( ! $this->registry->modules['blogs'])
            return '';
        
        
        // individual blog block
        if (is_numeric($arg))
        {
            return $this->_get_blog_block($arg);
        }
        
        // subscribe block
        elseif ($arg == 'subscribe.block')
        {
            return $this->_get_subscribe_block();
        }
        
        // recent blog post block
        elseif ($arg == 'recent.block')
        {
            return $this->_get_recent_block();
        }
        
        // blog categories block
        elseif ($arg == 'categories.block')
        {
            return $this->_get_categories_block();
        }
        
        return '';
    }
    
    
    // individual blog block
    private function _get_blog_block( $id = 0 )
    {
        // the url of the blogs page
        $data['link'] = '/' . $this->registry->modules['blogs'] . '/';
        
        // get blog info
        $blogs_model = load_model('blogs');
        $data['blog'] = $blogs_model->get_blog($id);
        
        // if blog not found
        if ( ! $data['blog']) return '';
        
        // add css
        $this->_add_css();
        
        // return html
        return load_view('blogs.blog.block.template.php', $data);
    }
    
    
    // subscribe block
    private function _get_subscribe_block()
    {
        // the url of the blogs page
        $data['link'] = '/' . $this->registry->modules['blogs'] . '/';
        
        // add css
        $this->_add_css();
        
        // return html
        return load_view('blogs.subscribe.block.template.php', $data);
    }
    
    
    // categories block
    private function _get_categories_block()
    {
        // the url of the blogs page
        $data['link'] = '/' . $this->registry->modules['blogs'] . '/';
        
        // add css
        $this->_add_css();
        
        // return html
        return load_view('blogs.categories.block.template.php', $data);
    }
    
    
    // recent blog post block
    private function _get_recent_block()
    {
        // the url of the blogs page
        $data['link'] = '/' . $this->registry->modules['blogs'] . '/';
        
        // add css
        $this->_add_css();
        
        // return html
        return load_view('blogs.recent.block.template.php', $data);
    }
    
}