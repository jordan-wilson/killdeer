<?php

class page_model extends model
{

    public function get_page( $url = '' )
    {
        $arr = array();
        
        switch($url)
        {
            case 'index':
                $arr['id'] = 1;
                $arr['url'] = 'index';
                $arr['module'] = '';
                $arr['content'] = '<h2>Welcome</h2><p>Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Vestibulum id ligula porta felis euismod semper. Donec id elit non mi porta gravida at eget metus.</p><p>Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>';
                $arr['meta_title'] = 'Home';
                $arr['meta_keywords'] = 'sed, posuere, consectetur est, at lobortis';
                $arr['meta_description'] = 'Sed posuere consectetur est at lobortis. Fusce dapibus tellus ac cursus.';
                $arr['layout'] = $this->get_layout(1);
                break;
            
            case 'error':
                $arr['id'] = 2;
                $arr['url'] = 'error';
                $arr['module'] = '';
                $arr['content'] = '<h2>Page Not Found</h2><p>The page you were looking for was not found.</p>';
                $arr['meta_title'] = 'Page not found';
                $arr['meta_keywords'] = '';
                $arr['meta_description'] = '';
                $arr['layout'] = $this->get_layout(1);
                break;
            
            case 'about':
                $arr['id'] = 3;
                $arr['url'] = 'about';
                $arr['module'] = '';
                $arr['content'] = '<h2>About Us</h2><p>Praesent sagittis lacus in elementum sodales lacus justo porttitor lacus vel dictum nisi dui nec turpis. Etiam at nisl nisl, sed porttitor dui. Proin eu laoreet mauris. Proin et massa et nulla pellentesque tempus et sed ligula. Ut congue feugiat enim.</p>';
                $arr['meta_title'] = 'About Us';
                $arr['meta_keywords'] = '';
                $arr['meta_description'] = 'Praesent sagittis lacus in elementum sodales lacus justo porttitor.';
                $arr['layout'] = $this->get_layout(2);
                break;
            
            case 'blog':
                $arr['id'] = 4;
                $arr['url'] = 'blog';
                $arr['module'] = 'blog';
                $arr['content'] = '<h2>Blog</h2><p>Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Vestibulum id ligula porta felis euismod semper. Donec id elit non mi porta gravida at eget metus.</p>';
                $arr['meta_title'] = 'Blog';
                $arr['meta_keywords'] = '';
                $arr['meta_description'] = '';
                $arr['layout'] = $this->get_layout(3);
                break;
            
            case 'contact':
                $arr['id'] = 5;
                $arr['url'] = 'contact';
                $arr['module'] = '';
                $arr['content'] = '<h2>Contact Us</h2><p>Etiam at nisl nisl sed porttitor dui. Proin eu laoreet mauris. Proin et massa et nulla pellentesque tempus et sed ligula. Ut congue feugiat enim.</p>';
                $arr['meta_title'] = 'Contact Us';
                $arr['meta_keywords'] = '';
                $arr['meta_description'] = '';
                $arr['layout'] = $this->get_layout(4);
                break;
        }
        
        return $arr;
    }
    
    
    public function get_layout( $id = 0 )
    {
        $arr = array();
        
        switch($id)
        {
            case 1:
                $arr = array(
                    'template' => 'layout.main.template.php',
                    'cells' => array(
                        1 => array('[content]'),
                        2 => array($this->get_block(6)),
                        3 => array(),
                        4 => array(),
                        5 => array(),
                        6 => array()
                    )
                );
                break;
            
            case 2: // about
                $arr = array(
                    'template' => 'layout.main.template.php',
                    'cells' => array(
                        1 => array('[content]'),
                        2 => array(
                            $this->get_block(1),
                            $this->get_block(2)
                        ),
                        3 => array($this->get_block(2)),
                        4 => array($this->get_block(3)),
                        5 => array($this->get_block(4)),
                        6 => array($this->get_block(5))
                    )
                );
                break;
            
            case 3: // blog
                $arr = array(
                    'template' => 'layout.blog.template.php',
                    'cells' => array(
                        1 => array('[content]'),
                        2 => array(
                            $this->get_block(1),
                            $this->get_block(7),
                            $this->get_block(3),
                            $this->get_block(8),
                            $this->get_block(9)
                        )
                    )
                );
                break;
            
            case 4: // contact
                $arr = array(
                    'template' => 'layout.main.template.php',
                    'cells' => array(
                        1 => array('[content]', '[forms:1]'),
                        2 => array($this->get_block(6), '[forms:2]'),
                        3 => array(),
                        4 => array(),
                        5 => array($this->get_block(3)),
                        6 => array('[forms:2]')
                    )
                );
                break;
            
        }
        
        return $arr;
    }
    
    
    public function get_block( $id = 0 )
    {
        $str = '';
        
        switch($id)
        {
            case 1:
                $str = '<h3>Block 1</h3><p>Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p><p>Vestibulum id ligula porta felis euismod semper. Donec id elit non mi porta gravida at eget metus.</p>';
                break;
            
            case 2:
                $str = '<h3>Block 2</h3><p>Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>';
                break;
            
            case 3:
                $str = '<h3>Block 3</h3><p>Ut fermentum massa justo sit amet risus. Vestibulum id ligula porta felis euismod semper. Donec id elit non mi porta gravida at eget metus.</p>';
                break;
            
            case 4:
                $str = '<h3>Block 4</h3><p>Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>';
                break;
            
            case 5:
                $str = '<h3>Block 5</h3><p>Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>';
                break;
            
            case 6:
                $str = '<h3>Block 6</h3><p>Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>';
                break;
            
            case 7:
                $str = '<h3>RSS SUBSCRIBE</h3>';
                break;
            
            case 8:
                $str = '<h3>Categories Block</h3><ul><li>Donec</li><li>Elit non</li><li>Mi porta gravida</li></ul>';
                break;
            
            case 9:            
                $str = '<h3>Recent Blogs</h3><ul><li>Donec id elit non mi</li><li>Porta gravida at eget metus</li><li>Vivamus sagittis lacus vel augue laoreet rutrum</li><li>At eget metus</li></ul>';
                break;
        }
        
        return $str;
    }
    
}