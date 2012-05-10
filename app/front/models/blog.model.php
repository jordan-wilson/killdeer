<?php

class blog_model extends model
{
    
    public function get_landing()
    {
        $arr = array();
        $arr[] = $this->blogs(4);
        $arr[] = $this->blogs(3);
        $arr[] = $this->blogs(2);
        $arr[] = $this->blogs(1);
        return $arr;
    }
    
    
    public function get_view( $url = '' )
    {
        switch( $url )
        {
            case 'blog1':
                return $this->blogs(1);
                break;
            case 'blog2':
                return $this->blogs(2);
                break;
            case 'blog3':
                return $this->blogs(3);
                break;
            case 'blog4':
                return $this->blogs(4);
                break;
        }
        
        return array();
    }
    
    
    public function blogs( $id = 0 )
    {
        $arr = array();
        
        $arr[1] = array(
            'url' => 'blog1',
            'date' => strtotime('January 2, 2012'),
            'name' => 'Blog 1',
            'content' => '<p>Ut fermentum massa justo sit amet risus. Vestibulum id ligula porta felis euismod semper. Donec id elit non mi porta gravida at eget metus.</p>',
            'page_heading' => 'Blog > Blog 1',
            'meta_title' => 'Blog :: Blog 1',
            'meta_keywords' => '',
            'meta_description' => ''
        );
        
        $arr[2] = array(
            'url' => 'blog2',
            'date' => strtotime('January 14, 2012'),
            'name' => 'Blog 2',
            'content' => '<p>Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>',
            'page_heading' => '',
            'meta_title' => 'Blog 2',
            'meta_keywords' => '',
            'meta_description' => ''
        );
        
        $arr[3] = array(
            'url' => 'blog3',
            'date' => strtotime('January 20, 2012'),
            'name' => 'Blog 3',
            'content' => '<p>Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>',
            'page_heading' => '',
            'meta_title' => 'Blog 3',
            'meta_keywords' => '',
            'meta_description' => ''
        );
        
        $arr[4] = array(
            'url' => 'blog4',
            'date' => strtotime('January 26, 2012'),
            'name' => 'Blog 4',
            'content' => '<p>Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>',
            'page_heading' => 'Blog > Blog 4',
            'meta_title' => 'Blog 4',
            'meta_keywords' => '',
            'meta_description' => ''
        );
        
        if ( $arr[$id] )
            return $arr[$id];
        
        return false;
    }

}