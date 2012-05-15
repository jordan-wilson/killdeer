<?php

class layouts_model extends model
{
    
    public function get_layout( $id = 0 )
    {
        $arr = array();
        
        switch($id)
        {
            case 1: // home
                $arr = array(
                    'template' => '',
                    'cells' => array(
                        1 => array('[content]'),
                        2 => array('[blocks:6]'),
                        3 => array('[blocks:2]'),
                        4 => array('[blogs:4]'),
                        5 => array('[forms:2]'),
                        6 => array('[blogs:recent.block]')
                    )
                );
                break;
            
            case 2: // about
                $arr = array(
                    'template' => '',
                    'cells' => array(
                        1 => array('[content]'),
                        2 => array('[blocks:1]', '[blocks:2]'),
                        3 => array('[blocks:2]'),
                        4 => array('[blocks:3]'),
                        5 => array('[blocks:4]'),
                        6 => array('[blocks:5]')
                    )
                );
                break;
            
            case 3: // blog
                $arr = array(
                    'template' => 'blogs',
                    'cells' => array(
                        1 => array('[content]','[blogs:content]'),
                        2 => array('[blocks:1]','[blogs:subscribe.block]','[blocks:3]','[blogs:categories.block]','[blogs:recent.block]')
                    )
                );
                break;
            
            case 4: // contact
                $arr = array(
                    'template' => '',
                    'cells' => array(
                        1 => array('[content]','[forms:1]'),
                        2 => array('[blocks:6]','[forms:2]'),
                        3 => array(),
                        4 => array(),
                        5 => array('[blocks:3]'),
                        6 => array('[forms:2]')
                    )
                );
                break;
                
            case 5: // error
                $arr = array(
                    'template' => '',
                    'cells' => array(
                        1 => array('[content]'),
                        2 => array('[blocks:6]'),
                        3 => array('[blocks:1]'),
                        4 => array('[blocks:2]'),
                        5 => array('[blocks:3]'),
                        6 => array('[forms:2]')
                    )
                );
                break;
            
            case 6: // blogs > blog 1, 2, 3, 4
                $arr = array(
                    'template' => 'blogs',
                    'cells' => array(
                        1 => array('[blogs:content]'),
                        2 => array('[blogs:subscribe.block]','[blogs:categories.block]','[blogs:recent.block]')
                    )
                );
                break;
            
        }
        
        return $arr;
    }
    
}