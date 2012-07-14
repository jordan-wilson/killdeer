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
        
    
    public function edit_info()
    {
        // get page id
        $request = $this->registry->request_args;
        $id = $request[0];
        
        // get blogs data
        $blogs_model = load_model('blogs');
        $data = $blogs_model->get_blog_from_id($id);
        
        // if data not found
        if ( ! count($data))
            error_page();
        
        // update content
        $this->content = load_view('blogs.edit_info.template.php', $data);
        
        // add css
        $this->_add_css();
        
        // load layout
        $this->display();
    }
    
    
    // update blog info
    public function update_info()
    {
        $input = load_core('input');
        $post  = $input->post();
        
        // update pages info
        $blogs_model = load_model('blogs');
        $updated = $blogs_model->update_blog_info($post);
        if ($updated === false)
            echo 'There was a problem updating this blog.';
        
        // return to edit info page
        $this->edit_info();
    }
    
    
    private function _add_css()
    {
        $css = '/skins/' . APP . '/' . $this->registry->skin . '/css/blogs.css';
        $this->registry->add_css_by_url($css);
    }
    
}