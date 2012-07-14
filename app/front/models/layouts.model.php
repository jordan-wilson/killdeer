<?php

class layouts_model extends model
{
    /*
        The layouts templates are pieced together using the "controller" and the "skin"
        format: CONTROLLER.SKIN.layout.php
        
        The "controller" variable tells the router which controller to load.
        Default controller is "pages".
        The modular controllers like "blogs" will replace the block '[content]' with the appropriate modular data.
        
        The "skin" just defines which layout to use. This way you can use different layouts for seperate sections under a single module.
        An example is the landing page for the blog (blogs.default.layout.php) has one large column and a thin right column,
        then the blog post page (blogs.post.layout.php) will have a skinny column for social stuff, a middle column, and
        then a thin right column.
        
        The "cells" contain all the blocks that have been added to it.
        Most blocks will have a format like '[blocks:6]'. This tells the "controller->parse_page_layout()" method to load the
        "blocks" controller (then call the "get_block()" method) and pass "6" as the argument and replace '[blocks:6]' with
        whatever gets returned.
    */
    
    // get the layout from the id
    public function get_layout_from_id( $id = 0 )
    {
        $arr = array();
        
        if ( ! is_numeric($id))
            return $arr;
        
        try
        {     
            $stmt = $this->db->prepare("SELECT * FROM layouts WHERE id = :id LIMIT 1");
            $stmt->execute( array(':id'=>$id) );
            if ($stmt->rowCount())
                $arr = $stmt->fetch();
        }
        catch(PDOException $e) { }
        
        return $arr;
    }
    
    // get unique controller types
    public function get_controllers_list()
    {
        $arr = array();
        
        try
        {     
            $stmt = $this->db->prepare("SELECT id, controller FROM layouts WHERE controller != '' AND skin = ''");
            $stmt->execute();
            if ($stmt->rowCount())
            {
                while ($result = $stmt->fetch())
                {
                    $arr[$result['controller']] = $result['id'];
                }
            }
        }
        catch(PDOException $e) { }
        
        return $arr;
    }
    
    /*
    public function get_layout( $id = 0 )
    {
        $arr = array();
        
        switch($id)
        {
            case 1: // home
                $arr = array(
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
                    'controller' => 'blogs',
                    'skin' => 'post',
                    'cells' => array(
                        1 => array('[blocks:7]'),
                        2 => array('[content]'),
                        3 => array('[blogs:subscribe]','[blogs:recent]','[blocks:1]','[blogs:categories]')
                    )
                );
                break;
            
            // there are enough fallbacks that this doesn't even matter
            //default: // default layout for pages without one
                //$arr = array(
                    //'controller' => '',
                    //'skin' => '',
                    //'cells' => array(
                        //1 => array('[content]')
                    //)
                //);
        }
        
        return $arr;
    }
    */
    
}