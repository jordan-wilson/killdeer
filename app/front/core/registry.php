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
    public $page_heading;
    
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
    
}