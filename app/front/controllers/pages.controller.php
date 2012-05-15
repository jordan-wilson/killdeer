<?php

class pages extends controller 
{
    
    public $data = array();
    
    public function index()
    {
        // get the urls of all the pages with modules
        $this->get_module_urls();
        
        // get page url
        $url = $this->registry->request_args[0];
        
        // get page info
        $pages_model = load_model('pages');
        $this->data = $pages_model->get_page($url);
        
        // if page not found
        if ( ! count($this->data))
           $this->error_page();
        
        // update page meta
        $this->update_meta($this->data);
        
        // update default page content
        $this->update_page_content();
        
        // update page layout
        $this->process_layouts();
        
        // display layout template
        $this->display();
    }
    
    
    private function get_module_urls()
    {
        // match the layout template name with the page that is using it
        // the "layout.blogs.template.php" is being used by the "blog" page
        // since there is no actual database right now i can't really build this function
        // it'll store all the urls in the registry so anything can access them
        $arr = array();
        $arr['blogs'] = 'blog';
        $this->registry->modules = $arr;
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
        $pages_model = load_model('pages');
        $this->data = $pages_model->get_page('error');
        
        // if error page not found
        if ( ! count($this->data))
            error_page();
        
        // update page meta
        $this->update_meta($this->data);
        
        // update default page content
        $this->update_page_content();
        
        // update page layout
        $this->process_layouts();
        
        // display error page
        header('HTTP/1.1 404 Not Found');
        $this->display();
        exit();
    }
    
    
    // load blocks into each cell of layout
    public function process_layouts()
    {
        // get layout data
        $layouts_model = load_model('layouts');
        $layout = $layouts_model->get_layout($this->data['layout']);
        
        // if there is layout data
        //$layout = $this->data['layout'];
        if (count($layout))
        {
            // load layout template
            if ($layout['template'] != '')
            {
                $template = 'layout.' . $layout['template'] . '.template.php';
                $path = SITE_ROOT . '/skins/' . APP . '/' . $this->registry->skin . '/' . $template;
                if (file_exists($path))
                    $this->main_template = $template;
            }
            
            // load block content into each cell of the layout
            foreach($layout['cells'] as $i => $cell)
            {
                foreach($cell as $j => $block)
                {
                    $html = '';
                    
                    // if regular page content
                    if ($block == '[content]')
                    {
                        //$html = $this->get_content('content');
                        $html = $this->registry->page_content;
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
                                    $html = $controller->get_block($matches[2]);
                                }
                            }
                        }
                    }
                    
                    // update cell content
                    $layout['cells'][$i][$j] = $html;
                }
            }
        }
        
        // update controller layout
        $this->layout = $layout;
    }
    
    
    // set the page content
    // some controllers will need to override page content
    private function update_page_content( $arg = '' )
    {
        $this->registry->page_content = load_view('pages.content.template.php', $this->data);
    }
    
}