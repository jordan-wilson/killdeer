<?php

class form_builder
{
    public $fields = array();
    public $attributes = array();
    public $button_text;
    
    public function __construct()
    {
        // SOME DEFAULT PARAMS
        $this->attributes = array('method'=>'post');
        $this->button_text = 'Submit';
    }
    
    // ADD FORM ATTRIBUTES
    public function set_attributes($params)
    {
        foreach ($params as $key => $value)
        {
            $this->attributes[$key] = $value;
        }
    }
    
    // SUBMIT BUTTON TEXT
    public function set_button_text($text)
    {
        $this->button_text = $text;
    }
    
    // TEXT INPUT
    public function add_text_input($name, $label, $params = array())
    {
        $this->fields[] = array('type'=>'text_input', 'name'=>$name, 'label'=>$label, 'params'=>$params);
    }
    
    // PASSWORD INPUT
    public function add_password_input($name, $label, $params = array())
    {
        $this->fields[] = array('type'=>'password_input', 'name'=>$name, 'label'=>$label, 'params'=>$params);
    }
    
    // SELECT BOX
    public function add_select($name, $label, $options = array(), $params = array())
    {
        $this->fields[] = array('type'=>'select', 'name'=>$name, 'label'=>$label, 'options'=>$options, 'params'=>$params);
    }
    
    // RADIO GROUP
    public function add_radio_group($name, $label, $options = array(), $params = array())
    {
        $this->fields[] = array('type'=>'radio', 'name'=>$name, 'label'=>$label, 'options'=>$options, 'params'=>$params);
    }
    
    // CHECKBOX GROUP
    public function add_checkbox_group($name, $label, $options = array(), $params = array())
    {
        if ( ! is_array($params['values']))
        {
            $params['values'] = array();
        }
        $this->fields[] = array('type'=>'checkbox', 'name'=>$name, 'label'=>$label, 'options'=>$options, 'params'=>$params);
    }
    
    // TEXTAREA
    public function add_textarea($name, $label, $params = array())
    {
        $this->fields[] = array('type'=>'textarea', 'name'=>$name, 'label'=>$label, 'params'=>$params);
    }
    
    // WYSIWYG
    public function add_wysiwyg($name, $label, $params = array())
    {
        $registry = load_core('registry');
        $registry->add_js_by_url('/lib/ckeditor/ckeditor.js');
        $registry->add_js_by_url('/lib/ckeditor/adapters/jquery.js');
        $this->fields[] = array('type'=>'wysiwyg', 'name'=>$name, 'label'=>$label, 'params'=>$params);
    }
    
    // DATE
    public function add_date($name, $label, $params = array())
    {
        $registry = load_core('registry');
        $registry->add_js_by_url('/lib/dateinput/dateinput.js');
        $registry->add_css_by_url('/lib/dateinput/dateinput.css');
        $this->fields[] = array('type'=>'date', 'name'=>$name, 'label'=>$label, 'params'=>$params);
    }
    
    // HIDDEN INPUT
    public function add_hidden_input($name, $value)
    {
        $this->fields[] = array('type'=>'hidden', 'name'=>$name, 'value'=>$value);
    } 
    
    // FILE INPUT
    public function add_file_input($name, $label, $params = array()) 
    {
        $registry = load_core('registry');
        $registry->add_js_by_url('/lib/swfobject.js');
        $registry->add_js_by_url('/lib/uploadify/jquery.uploadify.min.js');
        $registry->add_css_by_url('/lib/uploadify/uploadify.css');
        $this->fields[] = array('type'=>'file', 'name'=>$name, 'label'=>$label, 'params'=>$params);
    }
    
    // SECTION HEADING, NO INPUT
    public function add_section_heading($label)
    {
        $this->fields[] = array('type'=>'section_heading', 'label'=>$label);
    }
    
    // HTML, NO INPUT
    public function add_html($label, $html)
    {
        $this->fields[] = array('type'=>'html', 'label'=>$label, 'html'=>$html);
    }

}