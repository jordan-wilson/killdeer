<?php

class pages extends controller 
{
    
    public function layout()
    {
        // load main template
        $template = 'layout.main.template.php';
        $path = SITE_ROOT . '/skins/' . APP . '/' . $this->registry->skin . '/' . $template;
        if (file_exists($path))
            $this->registry->main_template = $template;
        
        
        // update page content
        $this->registry->page_content = load_view('pages.content.template.php', $this->registry->page_data);
    }
    
}