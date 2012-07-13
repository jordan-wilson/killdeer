<?php

class pages extends controller 
{
    
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
    
    
    public function edit()
    {
        // get page id
        $request = $this->registry->request_args;
        $id = $request[0];
        
        // get pages data
        $pages_model = load_model('pages');
        $data = $pages_model->get_page($id);
        
        // if data not found
        if ( ! count($data))
            error_page();
        
        // update content
        $this->content = load_view('pages.edit.template.php', $data);
        
        // add css
        $this->_add_css();
        
        // load layout
        $this->display();
    }
    
    
    public function layout()
    {
        // get page id
        $request = $this->registry->request_args;
        $id = $request[0];
        
        // get pages data
        $pages_model = load_model('pages');
        $data = $pages_model->get_page($id);
        
        // if data not found
        if ( ! count($data))
            error_page();
        
        // get layouts data
        $layouts_model = load_model('layouts');
        $data['layout'] = $layouts_model->get_layout($data['layout']);
        
        // update content
        $this->content = load_view('pages.layout.template.php', $data);
        
        // add css/js
        $this->_add_css();
        $this->_add_js();
        
        // update layout
        $this->main_layout = 'pages.layout.layout.php';
        
        // load layout
        $this->display();
    }
    
    
    private function _add_css()
    {
        $css = '/skins/' . APP . '/' . $this->registry->skin . '/css/pages.css';
        $this->registry->add_css_by_url($css);
        
        $css = '/skins/' . APP . '/' . $this->registry->skin . '/css/layouts.css';
        $this->registry->add_css_by_url($css);
    }
    
    
    private function _add_js()
    {
        $js = '/skins/' . APP . '/' . $this->registry->skin . '/js/layouts.js';
        $this->registry->add_js_by_url($js);
    }
    
}