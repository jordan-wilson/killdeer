<?php

class blogs extends controller 
{
    
    public function index()
    {
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
            /*
                Right now I'm just redirecting the user to the error page since
                I can't figure out how to load the error page using the pages
                controller in an efficient way. I'll probably need to stick it
                where everyone can call it. Like the base 'controller' or 
                'registry' classes.
            */
            header('Location: /error');
            exit();
        }
        
        // parse page layout
        //$this->parse_page_layout();
        
        // add css
        $this->_add_css();
        
        // output the page
        $this->display();
    }
    
    
    // blogs landing page
    private function _index()
    {
        // get recent blogs
        $blogs_model = load_model('blogs');
        $data['blogs'] = $blogs_model->get_blogs(0, 10);
        
        // add css
        //$this->_add_css();
        
        // return html
        return load_view('blogs.index.template.php', $data);
    }
    
    
    // individual blog post
    private function _view( $url = ''  )
    {
        // get blog data
        $blogs_model = load_model('blogs');
        $data['blog'] = $blogs_model->get_blog_from_url($url);
        
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
        //$layout = $layouts_model->get_layout($data['blog']['layout']);
        $layout = $layouts_model->get_layout_from_id($data['blog']['layout']);
        
        // update page layout
        if (count($layout))
            $this->registry->page_layout = $layout;
        
        // add css
        //$this->_add_css();
        
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
        
        // split the argument into an array by '.'
        $arg = explode('.', $arg);
        
        // find the method to call based on the arugements
        $block = is_numeric($arg[0]) ? 'blog' : $arg[0];
        $method = '_get_' . $block . '_block';
        
        // check for the method that returns the requested data
        if ( ! method_exists($this, $method))
            return '';
        
        // get the data
        $data = $this->$method($arg);
        
        // check if anything was returned
        if ( ! count($data))
            return '';
        
        // get the url of the blogs page
        $data['link'] = '/' . $this->registry->modules['blogs'] . '/';
        
        // add css
        $this->_add_css();
        
        // the default block template
        $default = 'blogs.' . $block . '.default.block.php';
        
        // if using custom template
        if ($arg[1])
        {
            // load the custom template
            // load the default template if its not found
            $template = 'blogs.' . $block . '.' . $arg[1] . '.block.php';
            return load_view($template, $data, $default);
        }
        
        // load the default template
        return load_view($default, $data);
    }
    
    
    // individual blog block
    private function _get_blog_block( $arg = array() )
    {
        // get blog info
        $blogs_model = load_model('blogs');
        $data['blog'] = $blogs_model->get_blog_from_id($arg[0]);
        
        return $data;
    }
    
    
    // subscribe block
    private function _get_subscribe_block( $arg = array() )
    {
        // if can subscribe
        $data['subscribe'] = true;
        
        return $data;
    }
    
    
    // categories block
    private function _get_categories_block( $arg = array() )
    {
        // get blog category data
        $data['category'] = 'some data here';
        
        return $data;
    }
    
    
    // recent blog post block
    private function _get_recent_block( $arg = array() )
    {
        // get recent blogs
        $blogs_model = load_model('blogs');
        $data['blogs'] = $blogs_model->get_blogs(0, 2);
        
        // add css
        $this->_add_css();
        
        return $data;
    }
    
}