<?php

class blocks_model extends model
{
    
    // get the block from the id
    public function get_block_from_id( $id = 0 )
    {
        $arr = array();
        
        if ( ! is_numeric($id) )
            return $arr;
        
        try
        {     
            $stmt = $this->db->prepare("SELECT * FROM blocks WHERE id = :id LIMIT 1");
            $stmt->execute( array(':id'=>$id) );
            if ($stmt->rowCount())
                $arr = $stmt->fetch();
        }
        catch(PDOException $e) { }
        
        return $arr;
    }
    
}