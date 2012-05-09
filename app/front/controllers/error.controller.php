<?php

class error extends controller
{

    public function page_not_found()
    {
        if (is_ajax_request()) 
        {
            echo 'Error: resource \'' . $this->registry->controller . ':' . $this->registry->action . '\' not found.';
        } 
        else
        {
            header('HTTP/1.1 404 Not Found');
            echo load_view('error.template.php', array('message'=>'Page not found'));
        }
        exit;
    }
    
    public function forbidden()
    {
        if (is_ajax_request())
        {
            echo 'You do not have permission to view this resource.';
        }
        else
        {
            header("HTTP/1.1 403 Forbidden");
            echo load_view('error.template.php', array('message'=>'Forbidden'));
        }
        exit;
    }

}