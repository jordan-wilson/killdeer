<?php

class pages extends controller 
{
    
    public function index()
    {
        // update page content
        //$this->registry->page_content = load_view('pages.content.template.php', $this->registry->page_data);
        //$this->registry->page_content = load_view('pages.index.content.php', $this->registry->page_data);
        
        // parse page layout
        //$this->parse_page_layout();
        
        // if error page update header
        if ($this->registry->page_data['url'] == 'error')
            header('HTTP/1.1 404 Not Found');
        
        // output the page
        $this->display();
    }
    
}