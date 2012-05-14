<?php

class page extends controller 
{
    
    public $data = array();
    
    public function index()
    {
        // get page url
        $url = count($this->registry->request_args) ? $this->registry->request_args[0] : 'index';
        
        
        // get page info
        $page_model = load_model('page');
        $this->data = $page_model->get_page($url);
        
        
        // if page not found
        if ( ! count($this->data))
           $this->error_page();
        
        
        // update page meta
        $this->update_meta($this->data);
        
        
        // if page is using a module
        if (trim($this->data['module']))
        {
            $module = load_controller($this->data['module']);
            if ($module)
            {
                if (method_exists($module, 'index'))
                {
                    $module->index($this->data);
                    //return;
                }
            }
        }
        
        
        // if page has a form attached
        /*
        if (trim($this->data['form_id']))
        {
            $forms = load_controller('forms');
            if ($forms)
            {
                if (method_exists($forms, 'index'))
                {
                    $this->data = $forms->index($this->data);
                }
            }
        }
        */
        
        
        // load default page view
        if ( ! $this->content)
            $this->content = load_view('page.index.template.php', $this->data);
        
        
        // update layout blocks
        $this->process_layouts();
        
        
        // display main template
        $this->display();
    }
    
    
    // update meta tags
    public function update_meta( $data = array() )
    {
        if (trim($data['meta_title']))
            $this->registry->meta_title = $data['meta_title'];

        if (trim($data['meta_keywords']))
            $this->registry->meta_keywords = $data['meta_keywords'];

        if (trim($data['meta_description']))
            $this->registry->meta_description = $data['meta_description'];
        
    }
    
    
    // display error page
    public function error_page()
    {
        // get error page info
        $page_model = load_model('page');
        $data = $page_model->get_page('error');
        
        // if error page not found
        if ( ! count($data))
            error_page();
        
        // update page meta
        $this->update_meta($data);
        
        // display error page
        header('HTTP/1.1 404 Not Found');
        $this->content = load_view('page.index.template.php', $data);
        $this->display();
        exit();
    }
    
    
    public function process_layouts()
    {
        $layout = $this->data['layout'];
        
        // load layout
        if (count($layout))
        {
            // load layout template
            $template = $layout['template'];
            $path = SITE_ROOT . '/skins/' . APP . '/' . $this->registry->skin . '/' . $template;
            if (file_exists($path))
                $this->main_template = $template;
            
            // replace modular blocks with actual content
            foreach($layout['cells'] as $i => $cell)
            {
                foreach($cell as $j => $block)
                {
                    
                    // if page content
                    if ($block == '[content]')
                    {
                        $layout['cells'][$i][$j] = $this->content;
                    }
                    
                    // else, try and look for modular content
                    else
                    {
                        // IF   $block   = '[forms:1]'
                        // THEN $matches = array('[forms:1]', 'forms', '1')
                        $matches = array();
                        preg_match('/^\[(.*):(.*)\]$/', $block, $matches);
                        if (count($matches) == 3)
                        {
                            $controller = load_controller($matches[1]);
                            if ($controller)
                            {
                                if (method_exists($controller, 'get_block'))
                                {
                                    $layout['cells'][$i][$j] = $controller->get_block($matches[2]);
                                }
                            }
                        }
                    }
                    
                }
            }
        }
        
        $this->layout = $layout;
    }
    
}