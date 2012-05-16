<?php

class pages_model extends model
{

    public function get_page( $url = '' )
    {
        $arr = array();
        
        switch($url)
        {
            case 'index':
                $arr['id'] = 1;
                $arr['url'] = 'index';
                $arr['content'] = '<h2>Welcome</h2><p>Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Vestibulum id ligula porta felis euismod semper. Donec id elit non mi porta gravida at eget metus.</p><p>Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>';
                $arr['meta_title'] = 'Home';
                $arr['meta_keywords'] = 'sed, posuere, consectetur est, at lobortis';
                $arr['meta_description'] = 'Sed posuere consectetur est at lobortis. Fusce dapibus tellus ac cursus.';
                $arr['layout'] = 1;
                break;
            
            case 'error':
                $arr['id'] = 2;
                $arr['url'] = 'error';
                $arr['content'] = '<h2>Page Not Found</h2><p>The page you were looking for was not found.</p>';
                $arr['meta_title'] = 'Page not found';
                $arr['meta_keywords'] = '';
                $arr['meta_description'] = '';
                $arr['layout'] = 5;
                break;
            
            case 'about':
                $arr['id'] = 3;
                $arr['url'] = 'about';
                $arr['content'] = '<h2>About Us</h2><p>Praesent sagittis lacus in elementum sodales lacus justo porttitor lacus vel dictum nisi dui nec turpis. Etiam at nisl nisl, sed porttitor dui. Proin eu laoreet mauris. Proin et massa et nulla pellentesque tempus et sed ligula. Ut congue feugiat enim.</p>';
                $arr['meta_title'] = 'About Us';
                $arr['meta_keywords'] = '';
                $arr['meta_description'] = 'Praesent sagittis lacus in elementum sodales lacus justo porttitor.';
                $arr['layout'] = 2;
                break;
            
            case 'blog':
                $arr['id'] = 4;
                $arr['url'] = 'blog';
                $arr['content'] = '<h2>Blog</h2><p>Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Vestibulum id ligula porta felis euismod semper. Donec id elit non mi porta gravida at eget metus.</p>';
                $arr['meta_title'] = 'Blog';
                $arr['meta_keywords'] = '';
                $arr['meta_description'] = '';
                $arr['layout'] = 3;
                break;
            
            case 'contact':
                $arr['id'] = 5;
                $arr['url'] = 'contact';
                $arr['content'] = '<h2>Contact Us</h2><p>Etiam at nisl nisl sed porttitor dui. Proin eu laoreet mauris. Proin et massa et nulla pellentesque tempus et sed ligula. Ut congue feugiat enim.</p>';
                $arr['meta_title'] = 'Contact Us';
                $arr['meta_keywords'] = '';
                $arr['meta_description'] = '';
                $arr['layout'] = 4;
                break;
        }
        
        return $arr;
    }
    
}