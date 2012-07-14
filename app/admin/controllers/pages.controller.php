<?php

class pages extends controller 
{
    
    // the landing page
    public function index()
    {
        // get list of pages
        $pages_model = load_model('pages');
        $data['pages'] = $pages_model->get_pages();
        
        // update content
        $this->content = load_view('pages.index.template.php', $data);
        
        // add css
        $this->_add_css();
        
        // load layout
        $this->display();
    }
    
    
    // edit the page info
    public function edit_info()
    {
        // get page id
        $request = $this->registry->request_args;
        $id = $request[0];
        
        // get pages data
        $pages_model = load_model('pages');
        $data = $pages_model->get_page_from_id($id);
        
        // if data not found
        if ( ! count($data))
            error_page();
        
        // update content
        $this->content = load_view('pages.edit_info.template.php', $data);
        
        // add css
        $this->_add_css();
        
        // load layout
        $this->display();
    }
    
    
    // update page info
    public function update_info()
    {
        $input = load_core('input');
        $post  = $input->post();
        
        // update pages info
        $pages_model = load_model('pages');
        $updated = $pages_model->update_page_info($post);
        if ($updated === false)
            echo 'There was a problem updating this page.';
        
        // return to edit info page
        $this->edit_info();
    }
    
    
    private function _add_css()
    {
        $css = '/skins/' . APP . '/' . $this->registry->skin . '/css/pages.css';
        $this->registry->add_css_by_url($css);
    }
    
    
    //private function _add_js()
    //{
        //$js = '/skins/' . APP . '/' . $this->registry->skin . '/js/pages.js';
        //$this->registry->add_js_by_url($js);
    //}
    
}