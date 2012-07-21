<?php

class layouts_model extends model
{
    /*
        The layouts templates are pieced together using the "controller" and the "skin"
        format: CONTROLLER.SKIN.template.php
        
        The "controller" tells the router which controller to load.
        Default controller is "pages".
        
        The "skin" just defines different templates to use. This way you can use different layouts for seperate sections under a single module.
        An example is the landing page for the blog (blogs.default.template.php) has one large column and a thin right column,
        then the blog post page (blogs.post.template.php) will have a skinny column for social stuff, a middle column, and
        then a thin right column.
        
        The `layout_cells` table contains the blocks that have been added to each cell of a layout (stored as a JSON string).
        Each "cell" has a unique 'name' attribute that is used to position it within the template using the global "parse_block()" function.
        
        Most blocks will have a format like '[blocks:6]'. This tells the "controller->parse_page_layout()" method to load the
        "blocks" controller (then call the "get_block()" method) and pass "6" as the argument and replace '[blocks:6]' with
        whatever gets returned.
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