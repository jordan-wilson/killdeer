<?php

class registry
{
    
    public $js = array();
    public $css = array();
    public $action;
    public $controller;
    
    public $meta_title;
    public $meta_keywords;
    public $meta_description;
    
    public $modules      = array();   // array of all page urls with modules
    public $page_data    = array();   // the info of the page
    public $page_layout  = array();   // the layout of the page
        
    public function __construct()
    {
        $this->skin = DEFAULT_SKIN;
    }
    
    public function add_js($js) 
	{
		$this->js[] = $js;
	}
	
    public function add_js_by_url($url) 
	{
		$js = '<script type="text/javascript" src="' . $url . '"></script>';
		if (!in_array($js,$this->js)) 
		{
			$this->add_js($js);
		}
	}
	
    public function add_css($css) 
	{
		$this->css[] = $css;
	}
	
    public function add_css_by_url($url, $media = 'all') 
	{
		$css = '<link rel="stylesheet" href="' . $url . '" media="' . $media . '" />';
		if (!in_array($css,$this->css)) 
		{
			$this->add_css($css);
		}
	}
    
    // update meta tags
    public function update_meta( $data = array() )
    {
        if (trim($data['meta_title']))
            $this->meta_title = $data['meta_title'];

        if (trim($data['meta_keywords']))
            $this->meta_keywords = $data['meta_keywords'];

        if (trim($data['meta_description']))
            $this->meta_description = $data['meta_description'];
        
    }
    
}