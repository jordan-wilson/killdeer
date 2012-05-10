<?php

class page_model extends model
{

    public function get_page( $url = '' )
    {
        $arr = array();
        
        switch($url)
        {
            case 'index':
                $arr['url'] = 'index';
                $arr['module'] = '';
                $arr['form_id'] = 0;
                $arr['content'] = '<p>Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Vestibulum id ligula porta felis euismod semper. Donec id elit non mi porta gravida at eget metus.</p><p>Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>';
                $arr['page_heading'] = 'Welcome';
                $arr['meta_title'] = 'Home';
                $arr['meta_keywords'] = 'sed, posuere, consectetur est, at lobortis';
                $arr['meta_description'] = 'Sed posuere consectetur est at lobortis. Fusce dapibus tellus ac cursus.';
                break;
            
            case 'error':
                $arr['url'] = 'error';
                $arr['module'] = '';
                $arr['form_id'] = 0;
                $arr['content'] = '<p>The page you were looking for was not found.</p>';
                $arr['page_heading'] = '';
                $arr['meta_title'] = 'Page not found';
                $arr['meta_keywords'] = '';
                $arr['meta_description'] = '';
                break;
            
            case 'about':
                $arr['url'] = 'about';
                $arr['module'] = '';
                $arr['form_id'] = 0;
                $arr['content'] = '<p>Praesent sagittis lacus in elementum sodales lacus justo porttitor lacus vel dictum nisi dui nec turpis. Etiam at nisl nisl, sed porttitor dui. Proin eu laoreet mauris. Proin et massa et nulla pellentesque tempus et sed ligula. Ut congue feugiat enim.</p>';
                $arr['page_heading'] = '';
                $arr['meta_title'] = 'About Us';
                $arr['meta_keywords'] = '';
                $arr['meta_description'] = 'Praesent sagittis lacus in elementum sodales lacus justo porttitor.';
                break;
            
            case 'blog':
                $arr['url'] = 'blog';
                $arr['module'] = 'blog';
                $arr['form_id'] = 0;
                $arr['content'] = '<p>Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Vestibulum id ligula porta felis euismod semper. Donec id elit non mi porta gravida at eget metus.</p>';
                $arr['page_heading'] = '';
                $arr['meta_title'] = 'Blog';
                $arr['meta_keywords'] = '';
                $arr['meta_description'] = '';
                break;
            
            case 'contact':
                $arr['url'] = 'contact';
                $arr['module'] = '';
                $arr['form_id'] = 1;
                $arr['content'] = '<p>Etiam at nisl nisl sed porttitor dui. Proin eu laoreet mauris. Proin et massa et nulla pellentesque tempus et sed ligula. Ut congue feugiat enim.</p>';
                $arr['page_heading'] = '';
                $arr['meta_title'] = 'Contact Us';
                $arr['meta_keywords'] = '';
                $arr['meta_description'] = '';
                break;
        }
        
        return $arr;
    }

}