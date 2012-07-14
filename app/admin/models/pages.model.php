<?php

class pages_model extends model
{
    
    // get all pages
    public function get_pages()
    {
        $arr = array();
        
        try
        {     
            $stmt = $this->db->prepare("SELECT * FROM pages ORDER BY name");
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
    
    
    // get the page from the id
    public function get_page_from_id( $id = 0 )
    {
        $arr = array();
        
        if ( ! is_numeric($id))
            return $arr;
        
        try
        {     
            $stmt = $this->db->prepare("SELECT * FROM pages WHERE id = :id LIMIT 1");
            $stmt->execute( array(':id'=>$id) );
            if ($stmt->rowCount())
                $arr = $stmt->fetch();
        }
        catch(PDOException $e) { }
        
        return $arr;
    }
    
    
    // update page info
    public function update_page_info( $arr = array() )
    {
        if ( ! is_array($arr))
            return false;
        
        try
        {
            extract($arr);
            $stmt = $this->db->prepare("UPDATE pages SET name = :name, url = :url, content = :content, meta_title = :meta_title, meta_keywords = :meta_keywords, meta_description = :meta_description WHERE id = :id LIMIT 1");
            $executed = $stmt->execute(array(
                ':id'               => $id, 
                ':name'             => $name, 
                ':url'              => $url, 
                ':content'          => $content, 
                ':meta_title'       => $meta_title, 
                ':meta_keywords'    => $meta_keywords, 
                ':meta_description' => $meta_description
            ));
            return $executed;
        }
        catch(PDOException $e) { }
        
        return false;
    }
    
    /*
    public function get_pages()
    {
        $arr = array();
        
        $arr[] = $this->get_page(1);
        $arr[] = $this->get_page(2);
        $arr[] = $this->get_page(3);
        $arr[] = $this->get_page(4);
        $arr[] = $this->get_page(5);
        
        return $arr;
    }
    
    
    public function get_page( $id = 0 )
    {
        $arr = array();
        
        if ( ! is_numeric($id))
            return $arr;
        
        switch($id)
        {
            case 1:
                $arr['id'] = 1;
                $arr['name'] = 'Home';
                $arr['url'] = 'index';
                $arr['content'] = '<h2>Welcome</h2><p>Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Vestibulum id ligula porta felis euismod semper. Donec id elit non mi porta gravida at eget metus.</p><p>Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>';
                $arr['meta_title'] = 'Home';
                $arr['meta_keywords'] = 'sed, posuere, consectetur est, at lobortis';
                $arr['meta_description'] = 'Sed posuere consectetur est at lobortis. Fusce dapibus tellus ac cursus.';
                $arr['layout'] = 1;
                break;
            
            case 2:
                $arr['id'] = 2;
                $arr['name'] = 'Error';
                $arr['url'] = 'error';
                $arr['content'] = '<h2>Page Not Found</h2><p>The page you were looking for was not found.</p>';
                $arr['meta_title'] = 'Page not found';
                $arr['meta_keywords'] = '';
                $arr['meta_description'] = '';
                $arr['layout'] = 5;
                break;
            
            case 3:
                $arr['id'] = 3;
                $arr['name'] = 'About';
                $arr['url'] = 'about';
                $arr['content'] = '<h2>About Us</h2><p>Praesent sagittis lacus in elementum sodales lacus justo porttitor lacus vel dictum nisi dui nec turpis. Etiam at nisl nisl, sed porttitor dui. Proin eu laoreet mauris. Proin et massa et nulla pellentesque tempus et sed ligula. Ut congue feugiat enim.</p>';
                $arr['meta_title'] = 'About Us';
                $arr['meta_keywords'] = '';
                $arr['meta_description'] = 'Praesent sagittis lacus in elementum sodales lacus justo porttitor.';
                $arr['layout'] = 2;
                break;
            
            case 4:
                $arr['id'] = 4;
                $arr['name'] = 'Blog';
                $arr['url'] = 'blog';
                $arr['content'] = '<h2>Blog</h2><p>Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Vestibulum id ligula porta felis euismod semper. Donec id elit non mi porta gravida at eget metus.</p>';
                $arr['meta_title'] = 'Blog';
                $arr['meta_keywords'] = '';
                $arr['meta_description'] = '';
                $arr['layout'] = 3;
                break;
            
            case 5:
                $arr['id'] = 5;
                $arr['name'] = 'Contact';
                $arr['url'] = 'contact';
                $arr['content'] = '<h2>Contact Us</h2><p>Etiam at nisl nisl sed porttitor dui. Proin eu laoreet mauris. Proin et massa et nulla pellentesque tempus et sed ligula. Ut congue feugiat enim.</p>';
                $arr['meta_title'] = 'Contact Us';
                $arr['meta_keywords'] = '';
                $arr['meta_description'] = '';
                $arr['layout'] = 4;
                break;
        }
        
        return $arr;
    }
    */
    
}