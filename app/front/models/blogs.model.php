<?php

class blogs_model extends model
{
    
    // get all blogs
    public function get_blogs( $start = 0, $perpage = 10 )
    {
        $arr = array();
        
        $start   = is_int($start)   ? $start   : 0;
        $perpage = is_int($perpage) ? $perpage : 10;
        
        try
        {     
            $stmt = $this->db->prepare("SELECT * FROM blogs ORDER BY date DESC LIMIT :start, :perpage");
            $stmt->bindValue(':start',   (int) $start,   PDO::PARAM_INT);
            $stmt->bindValue(':perpage', (int) $perpage, PDO::PARAM_INT);
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
    
    /*
    public function get_landing()
    {
        $arr = array();
        $arr[] = $this->get_blog(4);
        $arr[] = $this->get_blog(3);
        $arr[] = $this->get_blog(2);
        $arr[] = $this->get_blog(1);
        return $arr;
    }
    
    
    public function get_view( $url = '' )
    {
        switch( $url )
        {
            case 'blog1':
                return $this->get_blog(1);
                break;
            case 'blog2':
                return $this->get_blog(2);
                break;
            case 'blog3':
                return $this->get_blog(3);
                break;
            case 'blog4':
                return $this->get_blog(4);
                break;
        }
        
        return array();
    }
    
    
    public function get_blog( $id = 0 )
    {
        $arr = array();
        
        $arr[1] = array(
            'url' => 'blog1',
            'date' => strtotime('January 2, 2012'),
            'name' => 'Blog 1',
            'content' => '<p>Ut fermentum massa justo sit amet risus. Vestibulum id ligula porta felis euismod semper. Donec id elit non mi porta gravida at eget metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dictum quam sed eros vestibulum et auctor turpis mattis. Praesent viverra semper lectus, sed facilisis mauris tincidunt non.</p><p>Sed sed tortor eget neque facilisis imperdiet. Integer tortor urna, dignissim vitae tempor eget, egestas ut velit. Suspendisse varius elit nec eros imperdiet vel viverra est tristique. Quisque lacus augue, gravida et pretium sed, imperdiet quis ipsum. Integer a suscipit tortor. Nullam sit amet neque est.</p>',
            'meta_title' => 'Blog :: Blog 1',
            'meta_keywords' => '',
            'meta_description' => '',
            'layout' => 6
        );
        
        $arr[2] = array(
            'url' => 'blog2',
            'date' => strtotime('January 14, 2012'),
            'name' => 'Blog 2',
            'content' => '<p>Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Sed pellentesque fermentum rutrum.</p><p>Donec nec dui hendrerit libero imperdiet malesuada vel et dui. Aenean ut est a massa mollis lacinia. Cras metus quam, tincidunt vitae convallis a, ullamcorper a lorem. Aenean ante ipsum, porta quis sodales nec, tristique ac nunc. Pellentesque id ligula quam, in commodo nisi.</p>',
            'meta_title' => 'Blog 2',
            'meta_keywords' => '',
            'meta_description' => '',
            'layout' => 6
        );
        
        $arr[3] = array(
            'url' => 'blog3',
            'date' => strtotime('January 20, 2012'),
            'name' => 'Blog 3',
            'content' => '<p>Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh. Fusce malesuada congue quam mollis ullamcorper. Nulla est purus, consequat vitae rutrum quis, iaculis id augue. Mauris a vehicula enim.</p><p>Pellentesque quis turpis mi, eget lobortis nisl. Maecenas congue, dolor eu adipiscing egestas, felis ipsum commodo est, commodo hendrerit eros est vulputate lacus. Donec iaculis, nisl pretium interdum ornare, lacus odio luctus mi, et venenatis elit elit eget mi.</p>',
            'meta_title' => 'Blog 3',
            'meta_keywords' => '',
            'meta_description' => '',
            'layout' => 6
        );
        
        $arr[4] = array(
            'url' => 'blog4',
            'date' => strtotime('January 26, 2012'),
            'name' => 'Blog 4',
            'content' => '<p>Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Fusce dui justo, sollicitudin a auctor a, pulvinar eget lectus. Etiam tincidunt varius facilisis.</p><p>In vestibulum, leo eu malesuada mattis, odio quam elementum diam, at facilisis enim lacus sit amet erat. Maecenas nisi arcu, rhoncus eu lacinia in, lobortis in nunc. Nullam ac sem id enim viverra vestibulum ullamcorper at metus. Pellentesque laoreet mattis cursus.</p>',
            'meta_title' => 'Blog 4',
            'meta_keywords' => '',
            'meta_description' => '',
            'layout' => 6
        );
        
        if ( $arr[$id] )
            return $arr[$id];
        
        return false;
    }
    */

}