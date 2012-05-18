<?php

class blocks_model extends model
{
    
    public function get_block( $id = 0 )
    {
        $arr = array();
        
        switch($id)
        {
            case 1:
                $arr['skin'] = 'green';
                $arr['title'] = 'Block 1';
                $arr['content'] = '<p>Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p><p>Vestibulum id ligula porta felis euismod semper. Donec id elit non mi porta gravida at eget metus.</p>';
                break;
            
            case 2:
                $arr['skin'] = 'blue';
                $arr['title'] = 'Block 2';
                $arr['content'] = '<p>Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>';
                break;
            
            case 3:
                $arr['skin'] = '';
                $arr['title'] = 'Block 3';
                $arr['content'] = '<p>Ut fermentum massa justo sit amet risus. Vestibulum id ligula porta felis euismod semper. Donec id elit non mi porta gravida at eget metus.</p>';
                break;
            
            case 4:
                $arr['skin'] = '';
                $arr['title'] = 'Block 4';
                $arr['content'] = '<p>Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>';
                break;
            
            case 5:
                $arr['skin'] = '';
                $arr['title'] = 'Block 5';
                $arr['content'] = '<p>Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>';
                break;
            
            case 6:
                $arr['skin'] = '';
                $arr['title'] = 'Block 6';
                $arr['content'] = '<p>Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>';
                break;
                
            case 7:
                $arr['skin'] = '';
                $arr['title'] = 'Block 7';
                $arr['content'] = '<p>Facebook Like</p><p>Twitter Retweet</p><p>Google Plus</p>';
                break;
        }
        
        return $arr;
    }
    
}