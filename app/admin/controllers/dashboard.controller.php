<?php

class dashboard extends controller 
{
    
    public function index()
    {
        $data = array();
        $data['title'] = 'Dashboard';
        $data['content'] = 'Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Vestibulum id ligula porta felis euismod semper. Donec id elit non mi porta gravida at eget metus. Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.';
        
        // update content
        $this->content = load_view('dashboard.index.template.php', $data);
        
        // load main template view
        $this->display();
    }
    
}