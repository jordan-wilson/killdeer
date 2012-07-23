<?php

class layouts_model extends model
{
    /*
        The layouts templates are pieced together using the "controller" and the "view"
        format: CONTROLLER.VIEW.template.php
        
        The "controller" tells the router which controller to load.
        The default controller is "pages".
        
        The "view" just defines different templates to use. This way you can use different layouts for seperate sections under a single module.
        An example is the landing page for the blog (blogs.default.template.php) has one large column and a thin right column,
        then the blog post page (blogs.post.template.php) will have a completely different layout.
        
        The "cells" attribute in the `layouts` table contains a JSON string of the blocks that make up each cell in the layout.
        Each "cell" has a unique name that is used to position it within the template using the global "parse_cell()" function.
        
        The "get_layout_cells()" method below was part of an idea to seperate out the "cells" data into their own tables. But then I was
        still storing the individual block data as a JSON string to and it seemed silly to make it its own table when all I was doing
        was grabbing it all and combining it into an array. Seperating everything out into their own tables is only worthwhile if I
        intend to change the naming conventions used for the blocks associative arrays or need to do some queries where I find the
        number of instances a particular block is being used.
        Otherwise, it'll all end up as an array anyway, so why not just store it that way.
    */
    
    // get the layout
    public function get_layout_from_table( $table_id = 0, $table_name = '' )
    {
        $arr = array();
        
        if ( ! is_numeric($table_id))
            return $arr;
        
        if ($table_name == '')
            return $arr;
        
        try
        {     
            $stmt = $this->db->prepare("SELECT * FROM layouts WHERE table_id = :table_id AND table_name = :table_name LIMIT 1");
            $stmt->execute( array(':table_id'=>$table_id, ':table_name'=>$table_name) );
            if ($stmt->rowCount())
                $arr = $stmt->fetch();
        }
        catch(PDOException $e) { }
        
        return $arr;
    }
    
    
    /*
    // get the layout cells
    public function get_layout_cells( $layout_id = 0 )
    {
        $arr = array();
        
        if ( ! is_numeric($layout_id))
            return $arr;
        
        try
        {     
            $stmt = $this->db->prepare("SELECT * FROM layout_cells WHERE layout_id = :layout_id");
            $stmt->execute( array(':layout_id'=>$layout_id) );
            if ($stmt->rowCount())
            {
                while ($result = $stmt->fetch())
                {
                    $arr[$result['name']] = json_decode($result['blocks']);
                }
            }
        }
        catch(PDOException $e) { }
        
        return $arr;
    }
    */
    
    
    // get unique controller types
    public function get_controllers_list()
    {
        $arr = array();
        
        try
        {
            $stmt = $this->db->prepare("SELECT table_id, controller FROM layouts WHERE table_name = 'pages' AND controller != 'pages' AND controller != ''");
            $stmt->execute();
            if ($stmt->rowCount())
            {
                while ($result = $stmt->fetch())
                {
                    $arr[$result['controller']] = $result['table_id'];
                }
            }
        }
        catch(PDOException $e) { }
        
        return $arr;
    }
    
    
}