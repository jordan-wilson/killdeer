<?php

class pages_model extends model
{
    
    // get the page from the url
    public function get_page_from_url( $url = '' )
    {
        $arr = array();
        
        if ( $url == '' )
            return $arr;
        
        try
        {     
            $stmt = $this->db->prepare("SELECT * FROM pages WHERE url = :url AND enabled LIMIT 1");
            $stmt->execute( array(':url'=>$url) );
            if ($stmt->rowCount())
                $arr = $stmt->fetch();
        }
        catch(PDOException $e) { }
        
        return $arr;
    }
    
    
    // get the page url from the id
    public function get_page_url_from_id( $id = 0 )
    {
        $url = '';
        
        if ( ! is_numeric($id) )
            return $url;
        
        try
        {     
            $stmt = $this->db->prepare("SELECT url FROM pages WHERE id = :id AND enabled LIMIT 1");
            $stmt->execute( array(':id'=>$id) );
            if ($stmt->rowCount())
            {
                $result = $stmt->fetch();
                $url = $result['url'];
            }
        }
        catch(PDOException $e) { }
        
        return $url;
    }
    
    
}