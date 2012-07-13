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
                    'id' => 1,
                    'controller' => '',
                    'skin' => 'home',
                    'cells' => array(
                        1 => array('[content]'),
                        2 => array('[blocks:2]', '[blocks:6]'),
                        3 => array('[blogs:4]'),
                        4 => array('[forms:2]'),
                        5 => array('[blogs:recent]'),
                        6 => array('[blogs:recent.green]'),
                        7 => array('[blogs:4.full]')
                    )
                );
                break;
            
            case 2: // about
                $arr = array(
                    'id' => 2,
                    'controller' => '',
                    'skin' => 'skin1',
                    'cells' => array(
                        1 => array('[content]'),
                        2 => array('[blocks:1]', '[blocks:2]'),
                        3 => array('<h3>HTML Block</h3><p>This is written directly into the layout of this page without being added to the Blocks module.</p><p>Mauris varius accumsan orci, eu venenatis eros venenatis nec. Curabitur eu ipsum mauris. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>'),
                        4 => array('<h3>Another HTML Block</h3><p>Cras quam nisl, mattis eu vestibulum sed, commodo a tellus. Integer nunc nisl, fringilla sed fermentum sit amet, commodo at sapien. Ut nibh orci, volutpat eget ultrices at, aliquet porttitor lectus. Aliquam egestas gravida egestas</p>')
                    )
                );
                break;
            
            case 3: // blog
                $arr = array(
                    'id' => 3,
                    'controller' => 'blogs',
                    'skin' => '',
                    'cells' => array(
                        1 => array('[content]'),
                        2 => array('[blocks:1]','[blogs:subscribe]','[blocks:3]','[blogs:categories]','[blogs:recent]')
                    )
                );
                break;
            
            case 4: // contact
                $arr = array(   
                    'id' => 4,
                    'controller' => '',
                    'skin' => '',
                    'cells' => array(
                        1 => array('[content]','[forms:1]'),
                        2 => array('[blocks:6]','[forms:2]','[forms:2]')
                    )
                );
                break;
                
            case 5: // error
                $arr = array(
                    'id' => 5,
                    'controller' => '',
                    'skin' => '',
                    'cells' => array(
                        1 => array('[content]'),
                        2 => array('[blocks:6]')
                    )
                );
                break;
            
            case 6: // blog1, blog2, blog3, blog4
                $arr = array(
                    'id' => 6,
                    'controller' => 'blogs',
                    'skin' => 'post',
                    'cells' => array(
                        1 => array('[blocks:7]'),
                        2 => array('[content]'),
                        3 => array('[blogs:subscribe]','[blogs:recent]','[blocks:1]','[blogs:categories]')
                    )
                );
                break;
            
        }
        
        return $arr;
    }
    
}