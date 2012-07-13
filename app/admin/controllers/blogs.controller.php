<?php

class blogs extends controller 
{
    
    public function index()
    {
        // get list of blogs
        $blogs_model = load_model('blogs');
        $data['blogs'] = $blogs_model->get_blogs();
        
        // update content
        $this->content = load_view('blogs.index.template.php', $data);
        
        // add css
        $this->_add_css();
        
        // load layout
        $this->display();
    }
        
    
    public function edit()
    {
        // get page id
        $request = $this->registry->request_args;
        $id = $request[0];
        
        // get blogs data
        $blogs_model = load_model('blogs');
        $data = $blogs_model->get_blog($id);
        
        // if data not found
        if ( ! count($data))
            error_page();
        
        // update content
        $this->content = load_view('blogs.edit.template.php', $data);
        
        // add css
        $this->_add_css();
        
        // load layout
        $this->display();
    }
    
    
    private function _add_css()
    {
        $css = '/skins/' . APP . '/' . $this->registry->skin . '/css/blogs.css';
        $this->registry->add_css_by_url($css);
    }
    
}