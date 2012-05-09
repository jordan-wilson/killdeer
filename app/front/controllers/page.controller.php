<?php

class page extends controller 
{
    
    public function index()
    {
        // get page url
        $url = count($this->registry->request_args) ? $this->registry->request_args[0] : 'index';
        
        
        // get page info
        $page_model = load_model('page');
        $data = $page_model->get_page($url);
        
        
        // if page not found
        if ( ! count($data))
        {
           $this->error_page();
           return;
        }
        
        
        // update page meta
        $data = $this->update_meta($data);
        
        
        // if page is using a module
        if ( trim($data['module']) )
        {
            $controller = load_controller($data['module']);
            if ($controller)
            {
                if (method_exists($controller, 'index'))
                {
                    $controller->index($data, $this);
                    return;
                }
            }
        }


        // display default page view
        echo load_view('header.template.php');
        echo load_view('page.index.template.php', $data);
        echo load_view('footer.template.php');
    }
    
    
    // update meta tags
    public function update_meta( $data )
    {
        if (trim($data['meta_title']))
            $this->registry->meta_title = $data['meta_title'];

        if (trim($data['meta_keywords']))
            $this->registry->meta_keywords = $data['meta_keywords'];

        if (trim($data['meta_description']))
            $this->registry->meta_description = $data['meta_description'];
        
        if ( ! trim($data['header']))
            $data['header'] = $data['meta_title'];
        
        return $data;
    }
    
    
    // display error page
    public function error_page()
    {
        // get error page info
        $page_model = load_model('page');
        $data = $page_model->get_page('error');
        if ( ! count($data))
            error_page();
        
        // update page meta
        $data = $this->update_meta($data);
        
        // display error page
        header('HTTP/1.1 404 Not Found');
        echo load_view('header.template.php');
        echo load_view('page.index.template.php', $data);
        echo load_view('footer.template.php');
    }
    
}