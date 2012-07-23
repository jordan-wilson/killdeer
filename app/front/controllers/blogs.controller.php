<?php

class blogs extends controller 
{
    
    private $blogs_perpage = 5;
    private $blogs_start   = 0;
    private $newer_page    = '';
    private $older_page    = '';
    
    
    public function index()
    {
        // get url request
        $request = $this->registry->request_args;
        
        // rss feed
        if ($request[1] == 'rss')
            $this->_rss();
        
        // category page
        elseif ($request[1] == 'category' && $request[2] != '')
            $this->_category($request[2]);
        
        // blog post
        elseif ($request[1])
            $this->_post($request[1]);
        
        // landing page
        else
            $this->_index();
        
        
        // add css
        $this->_add_css();
        
        // output the page
        $this->display();
    }
    
    
    // blogs landing page
    private function _index()
    {
        // blog pagination
        $this->_blog_pagination();
        $data['newer_page'] = $this->newer_page;
        $data['older_page'] = $this->older_page;
        
        // get blogs within range
        $blogs_model = load_model('blogs');
        $data['blogs'] = $blogs_model->get_blogs( $this->blogs_start, $this->blogs_perpage );
        
        // update template data
        $this->_data = $data;
    }
    
    
    // individual blog post
    private function _post( $url = ''  )
    {
        // get blog data
        $blogs_model = load_model('blogs');
        $data['blog'] = $blogs_model->get_blog_from_url($url);
        
        // if blog not found
        if ( ! $data['blog'])
        {
            header('Location: /error');
            exit();
        }
        
        // update meta tags
        $this->registry->update_meta($data['blog']);
        
        
        // get the blog's layout
        $layouts_model = load_model('layouts');
        $layout = $layouts_model->get_layout_from_table($data['blog']['id'], 'blogs');
        if (count($layout))
        {
            // merge blog post and landing page cells together
            $layout['cells'] = json_decode($layout['cells'], true);
            $layout['cells'] = array_merge($this->registry->page_layout['cells'], $layout['cells']);
            
            // update page layout
            $this->registry->page_layout = $layout;
        }
        
        // force layout to use this view
        $this->registry->page_layout['view'] = 'post';
        
        
        // update template data
        $this->_data = $data;
    }
    
    
    // blogs by category
    private function _category( $url = ''  )
    {
        // get blog category info
        $blogs_model = load_model('blogs');
        $data['category'] = $blogs_model->get_category_from_url( $url );
        
        // if category not found
        if ( ! $data['category'])
        {
            header('Location: /error');
            exit();
        }
        
        // update meta tags
        $this->registry->update_meta($data['category']);
        
        
        // get the category's layout
        $layouts_model = load_model('layouts');
        $layout = $layouts_model->get_layout_from_table($data['category']['id'], 'blog_categories');
        if (count($layout))
        {
            // merge blog category and landing page cells together
            $layout['cells'] = json_decode($layout['cells'], true);
            $layout['cells'] = array_merge($this->registry->page_layout['cells'], $layout['cells']);
            
            // update page layout
            $this->registry->page_layout = $layout;
        }
        
        // force layout to use this view
        $this->registry->page_layout['view'] = 'category';
        
        
        // blog pagination
        $this->_blog_pagination();
        $data['newer_page'] = $this->newer_page;
        $data['older_page'] = $this->older_page;
        
        // get blogs within range
        $blogs_model = load_model('blogs');
        $data['blogs'] = $blogs_model->get_blogs_by_category( $data['category']['id'], $this->blogs_start, $this->blogs_perpage );
        
        
        // update template data
        $this->_data = $data;
    }
    
    
    // the rss feed
    private function _rss()
    {
        // get 5 recent blogs
        $blogs_model = load_model('blogs');
        $data['blogs'] = $blogs_model->get_blogs(0, 5);
        
        // the blog rss title and description
        $data['rss_title'] = 'Blog';
        $data['rss_description'] = 'Curabitur hendrerit commodo mi sed iaculis donec consequat vulputate porta.';
        
        // the full url of the site
        $data['site_url'] = ($_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://') . $_SERVER['SERVER_NAME'] . '/';
        
        // if no blogs
        if ( ! count($data))
        {
            header('Location: /error');
            exit();
        }
        
        // exit with rss template
        header('Content-type: text/xml');
        echo load_view('blogs.rss.template.php', $data);
        exit();
    }
    
    
    // the pagination for the blog landing page
    private function _blog_pagination()
    {
        $input = load_core('input');
        
        // get current page
        $pg = 1;
        if ( $input->get('pg') )
        {
            $pg = $input->get('pg');
            $pg = is_numeric($pg) ? round($pg) : 1;
            $pg = ($pg < 1) ? 1 : $pg;
        }
        
        // get total number of blogs
        $blogs_model = load_model('blogs');
        $total_blogs = $blogs_model->get_total_number_of_blogs();
        
        if ( $total_blogs )
        {
            // get blogs per page and total pages
            $perpage = $this->blogs_perpage;
            $total_pages = ceil($total_blogs / $perpage);
            
            // if there are multiple pages
            if ( $total_pages > 1)
            {
                if ($pg > $total_pages)
                    $pg = $total_pages;
                
                // blog to start on
                $this->blogs_start = ($pg - 1) * $perpage;
                
                // set previous and next page
                $newer_page = ($pg - 1);
                $older_page = ($pg + 1);
                
                /*
                $blog_page_link = $this->registry->page_data['url'];
                
                if ($newer_page > 1)
                    $this->newer_page = $blog_page_link . '?pg=' . $newer_page;
                
                if ($newer_page == 1)
                    $this->newer_page = $blog_page_link;
                    
                if ($older_page <= $total_pages)
                    $this->older_page = $blog_page_link . '?pg=' . $older_page;
                */
                
                $query = array();
                $request_uri = $_SERVER['REQUEST_URI'];
                
                // is there a query string
                $position = strrpos($request_uri, "?");
                if ($position != FALSE)
                {
                    // get query string from url
                    $query_str = substr($request_uri, ($position + 1));
                    parse_str($query_str, $query);
                    
                    // remove existing page number
                    if ( array_key_exists('pg', $query) )
                        unset($query['pg']);
                    
                }
                
                // get url without query string
                $request_url = substr($request_uri, 0, $position);
                
                // rebuild the query string
                $query = http_build_query($query);
                
                // add the query back onto the url
                $request_url = $request_url . ($query == '' ? '' : '?' . $query);
                
                if ($newer_page > 1)
                    $this->newer_page = $request_url . ($query == '' ? '?' : '&') . 'pg=' . $newer_page;
                
                if ($newer_page == 1)
                    $this->newer_page = $request_url;
                    
                if ($older_page <= $total_pages)
                    $this->older_page = $request_url . ($query == '' ? '?' : '&') . 'pg=' . $older_page;
                
            }
        }
        
    }
    
    
        
    /***** BLOCKS *****/
    
    // get blog block
    public function get_block( $block = array() )
    {
        if ( ! is_array($block))
            return '';
        
        // check if the blogs module is on a page
        if ( ! $this->registry->modules['blogs'])
            return '';
        
        // find the method to call based on the arugements
        $view = empty($block['view']) ? 'blog' : $block['view'];
        $method = '_get_' . $view . '_block';
        
        // check for the method that returns the requested data
        if ( ! method_exists($this, $method))
            return '';
        
        // get the data for the block
        $data = $this->$method($block);
        if ( ! count($data))
            return '';
        
        // add css
        $this->_add_css();
        
        $view = 'blogs.' . $view . '.php';
        return load_view($view, $data);
    }
    
    
    // individual blog block
    private function _get_blog_block( $block = array() )
    {
        if ( ! is_array($block))
            return array();
        
        // get blog info
        $blogs_model = load_model('blogs');
        $data['blog'] = $blogs_model->get_blog_from_id($block['id']);
        
        return $data;
    }
    
    
    // individual blog block (full blog post)
    private function _get_blogfull_block( $block = array() )
    {
        if ( ! is_array($block))
            return array();
        
        // get blog info
        $blogs_model = load_model('blogs');
        $data['blog'] = $blogs_model->get_blog_from_id($block['id']);
        
        return $data;
    }
    
    
    // subscribe block
    private function _get_subscribe_block( $block = array() )
    {
        // if can subscribe
        $data['subscribe'] = true;
        
        return $data;
    }
    
    
    // categories block
    private function _get_categories_block( $block = array() )
    {
        // get blog category data
        $blogs_model = load_model('blogs');
        $data['categories'] = $blogs_model->get_categories();
        
        return $data;
    }
    
    
    // recent blog post block
    private function _get_recent_block( $block = array() )
    {
        // get recent blogs
        $blogs_model = load_model('blogs');
        $data['blogs'] = $blogs_model->get_blogs(0, 2);
        
        return $data;
    }
    
    
    // recent blog post block (green background)
    private function _get_recent2_block( $block = array() )
    {
        // get recent blogs
        $blogs_model = load_model('blogs');
        $data['blogs'] = $blogs_model->get_blogs(0, 2);
        
        return $data;
    }
    
    
        
    /***** COMMON *****/
    
    // add the style sheet
    private function _add_css()
    {
        $css = '/skins/' . APP . '/' . $this->registry->skin . '/css/blogs.css';
        $this->registry->add_css_by_url($css);
    }
    
}