<?php

class blogs_model extends model
{
    
    public function get_blogs()
    {
        $arr = array();
        
        $arr[] = $this->get_blog(1);
        $arr[] = $this->get_blog(2);
        $arr[] = $this->get_blog(3);
        $arr[] = $this->get_blog(4);
        
        return $arr;
    }
    
    
    public function get_blog( $id = 0 )
    {
        $arr = array();
        
        if ( ! is_numeric($id))
            return $arr;
        
        switch($id)
        {
            case 1:
                $arr['id'] = 1;
                $arr['name'] = 'Blog 1';
                $arr['url'] = 'blog1';
                $arr['date'] = strtotime('January 2, 2012');
                $arr['content'] = '<p>Ut fermentum massa justo sit amet risus. Vestibulum id ligula porta felis euismod semper. Donec id elit non mi porta gravida at eget metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dictum quam sed eros vestibulum et auctor turpis mattis. Praesent viverra semper lectus, sed facilisis mauris tincidunt non.</p><p>Sed sed tortor eget neque facilisis imperdiet. Integer tortor urna, dignissim vitae tempor eget, egestas ut velit. Suspendisse varius elit nec eros imperdiet vel viverra est tristique. Quisque lacus augue, gravida et pretium sed, imperdiet quis ipsum. Integer a suscipit tortor. Nullam sit amet neque est.</p>';
                $arr['meta_title'] = 'Blog 1';
                $arr['meta_keywords'] = '';
                $arr['meta_description'] = '';
                $arr['layout'] = 6;
                break;
            
            case 2:
                $arr['id'] = 2;
                $arr['name'] = 'Blog 2';
                $arr['url'] = 'blog2';
                $arr['date'] = strtotime('January 14, 2012');
                $arr['content'] = '<p>Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Sed pellentesque fermentum rutrum.</p><p>Donec nec dui hendrerit libero imperdiet malesuada vel et dui. Aenean ut est a massa mollis lacinia. Cras metus quam, tincidunt vitae convallis a, ullamcorper a lorem. Aenean ante ipsum, porta quis sodales nec, tristique ac nunc. Pellentesque id ligula quam, in commodo nisi.</p>';
                $arr['meta_title'] = 'Blog 2';
                $arr['meta_keywords'] = '';
                $arr['meta_description'] = '';
                $arr['layout'] = 6;
                break;
            
            case 3:
                $arr['id'] = 3;
                $arr['name'] = 'Blog 3';
                $arr['url'] = 'blog3';
                $arr['date'] = strtotime('January 20, 2012');
                $arr['content'] = '<p>Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh. Fusce malesuada congue quam mollis ullamcorper. Nulla est purus, consequat vitae rutrum quis, iaculis id augue. Mauris a vehicula enim.</p><p>Pellentesque quis turpis mi, eget lobortis nisl. Maecenas congue, dolor eu adipiscing egestas, felis ipsum commodo est, commodo hendrerit eros est vulputate lacus. Donec iaculis, nisl pretium interdum ornare, lacus odio luctus mi, et venenatis elit elit eget mi.</p>';
                $arr['meta_title'] = 'Blog 3';
                $arr['meta_keywords'] = '';
                $arr['meta_description'] = '';
                $arr['layout'] = 6;
                break;
            
            case 4:
                $arr['id'] = 4;
                $arr['name'] = 'Blog 4';
                $arr['url'] = 'blog4';
                $arr['date'] = strtotime('January 26, 2012');
                $arr['content'] = '<p>Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Fusce dui justo, sollicitudin a auctor a, pulvinar eget lectus. Etiam tincidunt varius facilisis.</p><p>In vestibulum, leo eu malesuada mattis, odio quam elementum diam, at facilisis enim lacus sit amet erat. Maecenas nisi arcu, rhoncus eu lacinia in, lobortis in nunc. Nullam ac sem id enim viverra vestibulum ullamcorper at metus. Pellentesque laoreet mattis cursus.</p>';
                $arr['meta_title'] = 'Blog 4';
                $arr['meta_keywords'] = '';
                $arr['meta_description'] = '';
                $arr['layout'] = 6;
                break;
            
        }
        
        return $arr;
    }
    
}