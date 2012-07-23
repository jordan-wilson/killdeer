<?php

class blogs_model extends model
{
    
    // get the total number of blogs
    public function get_total_number_of_blogs()
    {
        $total = 0;
        
        try
        {
            $stmt = $this->db->prepare("SELECT id FROM blogs WHERE date < :now AND enabled");
            $stmt->execute( array(':now'=>time()) );
            $total = $stmt->rowCount();
        }
        catch(PDOException $e) {echo $e; }
        
        return $total;
    }
    
    
    // get all blogs
    public function get_blogs( $start = 0, $perpage = 10 )
    {
        $arr = array();
        
        $start   = is_numeric($start)   ? $start   : 0;
        $perpage = is_numeric($perpage) ? $perpage : 10;
        
        try
        {     
            $stmt = $this->db->prepare("SELECT * FROM blogs WHERE date < :now AND enabled ORDER BY date DESC LIMIT :start, :perpage");
            $stmt->bindValue(':start',   (int) $start,   PDO::PARAM_INT);
            $stmt->bindValue(':perpage', (int) $perpage, PDO::PARAM_INT);
            $stmt->bindValue(':now',     time(),         PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount())
            {
                while ($result = $stmt->fetch())
                {
                    $arr[] = $result;
                }
            }
        }
        catch(PDOException $e) { }
        
        return $arr;
    }
    
    
    // get the blog from the url
    public function get_blog_from_url( $url = '' )
    {
        $arr = array();
        
        if (empty($url))
            return $arr;
        
        try
        {     
            $stmt = $this->db->prepare("SELECT * FROM blogs WHERE url = :url LIMIT 1");
            $stmt->execute( array(':url'=>$url) );
            if ($stmt->rowCount())
                $arr = $stmt->fetch();
        }
        catch(PDOException $e) { }
        
        return $arr;
    }
    
    
    // get the blog from the id
    public function get_blog_from_id( $id = 0 )
    {
        $arr = array();
        
        if ( ! is_numeric($id))
            return $arr;
        
        try
        {     
            $stmt = $this->db->prepare("SELECT * FROM blogs WHERE id = :id LIMIT 1");
            $stmt->execute( array(':id'=>$id) );
            if ($stmt->rowCount())
                $arr = $stmt->fetch();
        }
        catch(PDOException $e) { }
        
        return $arr;
    }
    
    
    // get all blog categories
    public function get_categories()
    {
        $arr = array();
        
        try
        {     
            $stmt = $this->db->prepare("SELECT * FROM blog_categories WHERE enabled ORDER BY name");
            $stmt->execute();
            if ($stmt->rowCount())
            {
                while ($result = $stmt->fetch())
                {
                    $arr[] = $result;
                }
            }
        }
        catch(PDOException $e) { }
        
        return $arr;
    }
    
    
    // get the blog category from the url
    public function get_category_from_url( $url = '' )
    {
        $arr = array();
        
        if (empty($url))
            return $arr;
        
        try
        {     
            $stmt = $this->db->prepare("SELECT * FROM blog_categories WHERE url = :url LIMIT 1");
            $stmt->execute( array(':url'=>$url) );
            if ($stmt->rowCount())
                $arr = $stmt->fetch();
        }
        catch(PDOException $e) { }
        
        return $arr;
    }
    
    
    // get blogs by category
    public function get_blogs_by_category( $category_id, $start = 0, $perpage = 10 )
    {
        $arr = array();
        
        if ( ! is_numeric($category_id))
            return $arr;
            
        $start   = is_numeric($start)   ? $start   : 0;
        $perpage = is_numeric($perpage) ? $perpage : 10;
        
        try
        {     
            $stmt = $this->db->prepare("SELECT * FROM blogs WHERE date < :now AND enabled ORDER BY date DESC LIMIT :start, :perpage");
            $stmt->bindValue(':start',   (int) $start,   PDO::PARAM_INT);
            $stmt->bindValue(':perpage', (int) $perpage, PDO::PARAM_INT);
            $stmt->bindValue(':now',     time(),         PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount())
            {
                while ($result = $stmt->fetch())
                {
                    $arr[] = $result;
                }
            }
        }
        catch(PDOException $e) { }
        
        return $arr;
    }

}