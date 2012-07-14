<?php

class layouts extends controller 
{
    
    // the landing page
    public function index()
    {
        // get list of layouts
        $layouts_model = load_model('layouts');
        $data['layouts'] = $layouts_model->get_layouts();
        
        // update content
        $this->content = load_view('layouts.index.template.php', $data);
        
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
        
        // get page data
        //$pages_model = load_model('pages');
        //$data = $pages_model->get_page_from_id($id);
        
        // if data not found
        //if ( ! count($data))
            //error_page();
        
        // get layout data
        $layouts_model = load_model('layouts');
        //$data['layout'] = $layouts_model->get_layout_from_id($data['layout']);
        $data['layout'] = $layouts_model->get_layout_from_id($id);
        
        // if layout data not found
        if ( ! count($data['layout']))
            error_page();
            
        // change the cells json string into an array
        $data['layout']['cells'] = json_decode($data['layout']['cells']);
        array_unshift( $data['layout']['cells'], array() );
        
        // update content
        $this->content = load_view('layouts.edit.template.php', $data);
        
        // add css/js
        $this->_add_css();
        $this->_add_js();
        
        // update layout
        //$this->main_layout = 'pages.layout.layout.php';
        
        // load layout
        $this->display();
    }
    
    
    /*
    // update page info
    public function update_info()
    {
        $input = load_core('input');
        $post  = $input->post();
        
        // update pages info
        $pages_model = load_model('pages');
        $updated = $pages_model->update_info($post);
        if ($updated === false)
            echo 'problem';
        
        // return to edit info page
        $this->edit_info();
    }
    */
    
    
    private function _add_css()
    {
        $css = '/skins/' . APP . '/' . $this->registry->skin . '/css/layouts.css';
        $this->registry->add_css_by_url($css);
    }
    
    
    private function _add_js()
    {
        $js = '/skins/' . APP . '/' . $this->registry->skin . '/js/layouts.js';
        $this->registry->add_js_by_url($js);
    }
    
}