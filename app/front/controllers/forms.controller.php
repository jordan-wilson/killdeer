<?php

class forms extends controller 
{
    
    private $submitted;
    private $forms = array();
    
    public function get_block( $id = 0 )
    {
        if ( ! is_numeric($id)) return '';
        
        // check if form is unique
        if (in_array($id, $this->forms))
            return '<div class="forms_block" style="padding:5px; color:#fff; background-color:#870217">Form ' . $id . ' is already in use on this page. Only one instance of a form is allowed on the page.</div>';
        
        $this->forms[] = $id;
        
        // get the page url
        $request = $this->registry->request_args;
        if ( ! count($request)) return '';
        $url = $request[0];
        
        // check if this form has been submitted
        // url would look like this: www.site.com/page/5/submit
        $this->submitted = false;
        $action = count($request) > 2 ? array_pop($request) : false;
        $formid = count($request) > 1 ? array_pop($request) : false;
        if ($action == 'submit' && is_numeric($formid))
        {
            // if this form was submitted
            if ($formid == $id)
            {
                // return either the form with errors or thank you text
                $this->submitted = true;
                return $this->_build_form($id, $url, true);
            }
        }
        
        // return the form
        return $this->_build_form($id, $url);
    }
    
    
    private function _build_form( $id = 0, $url = '', $validate = false )
    {
        // get form info
        $forms_model = load_model('forms');
        $form = $forms_model->get_form($id);
        
        // if no form was found
        if ( ! $form)
            return '';
        
        // if no form fields
        if ( ! count($form['fields']))
            return '';
        
        
        // process each form field
        $fields = array();
        foreach($form['fields'] AS $field)
        {
            $fields[] = $this->get_field($field, $validate);
        }
        $fields = array_filter($fields);
        
        
        // if no form fields
        if ( ! count($fields))
            return '';
        
        
        // add css
        $this->_add_css();
        
        
        // build the data array
        $data = array();
        $data['type'] = $form['type'];
        $data['fields'] = join('', $fields);
        $data['content'] = $form['content'];
        $data['submitted'] = $this->submitted;
        
        // the anchor link
        $data['name'] = 'form' . $form['id'];
        
        // the post url
        $data['action'] = '/' . $url . '/' . $form['id'] . '/submit#' . $data['name'];
        
        // load view
        return load_view('forms.default.block.php', $data);
    }
    
    
    private function _add_css()
    {
        $css = '/skins/' . APP . '/' . $this->registry->skin . '/css/forms.css';
        $this->registry->add_css_by_url($css);
    }
    
    
    public function get_field( $arr = array(), $validate = array() )
    {
        switch($arr['type'])
        {
            case 'text_input':
                return $this->_get_text_input($arr, $validate);
                break;
            
            case 'textarea':
                return $this->_get_textarea($arr, $validate);
                break;
            
            case 'select':
                return $this->_get_select($arr, $validate);
                break;
            
            case 'heading':
                return $this->_get_heading($arr);
                break;
        }
        return false;
    }
    
    
    // focus on first incomplete field
    private function _add_input_focus( $id = '' )
    {
        if ($this->submitted)
        {
            $js = '<script>$(function () { $("#' . $id . '").focus(); });</script>';
            $this->registry->add_js($js);
        }
    }
    
    
    // label
    private function _get_field_label( $id = 0, $arr = array() )
    {
        $html = '';
        
        $label = trim($arr['label']);
        if ($label)
        {
            $html .= '<label class="form_label" for="' . $id . '">';
                $html .= $label . ($arr['required'] ? '*' : '');
            $html .= '</label>';
        }
        
        return $html;
    }
    
    
    // text input
    private function _get_text_input( $arr = array(), $validate = false )
    {
        $id = 'field_' . $arr['id'];
        $value = load_core('input')->post($id);
        $value = trim($value);
        
        if ($validate)
        {
            if ($arr['required'])
            {
                if (empty($value))
                {
                    $error = '<div class="form_error">Please fill in this required field.</div>';
                    $this->_add_input_focus($id);
                    $this->submitted = false;
                }
            }
        }
        
        $html .= '<div class="input_container">';
            $html .= $this->_get_field_label($id, $arr);
            $html .= '<div class="form_field">';
                $html .= '<input type="text" id="' . $id . '" name="' . $id . '" value="' . htmlentities($value) . '" />';
                $html .= $error;
            $html .= '</div>';
        $html .= '</div>';
        
        return $html;
    }
    
    
    // textarea
    private function _get_textarea( $arr = array(), $validate = false )
    {
        $id = 'field_' . $arr['id'];
        $value = load_core('input')->post($id);
        $value = trim($value);
        
        if ($validate)
        {
            if ($arr['required'])
            {
                if (empty($value))
                {
                    $error = '<div class="form_error">Please fill in this required field.</div>';
                    $this->_add_input_focus($id);
                    $this->submitted = false;
                }
            }
        }
        
        $html .= '<div class="input_container">';
            $html .= $this->_get_field_label($id, $arr);
            $html .= '<div class="form_field">';
                $html .= '<textarea id="' . $id . '" name="' . $id . '">' . $value . '</textarea>';
                $html .= $error;
            $html .= '</div>';
        $html .= '</div>';
        
        return $html;
    }
    
    
    // select
    private function _get_select( $arr = array(), $validate = false )
    {
        $id = 'field_' . $arr['id'];
        $value = load_core('input')->post($id);
        $value = trim($value);
        
        if ($validate)
        {
            if ($arr['required'])
            {
                if (empty($value))
                {
                    $error = '<div class="form_error">Please select an option.</div>';
                    $this->_add_input_focus($id);
                    $this->submitted = false;
                }
            }
        }
        
        $html .= '<div class="input_container">';
            $html .= $this->_get_field_label($id, $arr);
            $html .= '<div class="form_field">';
                $html .= '<select id="' . $id . '" name="' . $id . '">';
                    $html .= '<option value=""></option>';
                    foreach($arr['options'] AS $option)
                    {
                        $html .= '<option value="' . $option . '">' . $option . '</option>';
                    }
                $html .= '</select>';
                $html .= $error;
            $html .= '</div>';
        $html .= '</div>';
        
        return $html;
    }
    
    
    // heading
    private function _get_heading( $arr = array() )
    {
        $html .= '<div class="input_heading">';
            $html .= $arr['label'];
        $html .= '</div>';
        
        return $html;
    }
    
    
    
}