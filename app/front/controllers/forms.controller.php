<?php

class forms extends controller 
{
    
    /*
        if a form is submitted, $submitted is set to true and each form field
        is validated. $submitted is switched to false on the first field that
        doesn't validate. if $submitted is still true at the end of the process
        when the form view is loaded, then the form's content is shown instead
        of the form.
    */
    
    private $submitted = false;   // whether this form has been submitted
    private $forms = array();     // track all the forms being displayed on the page
    
    
    public function get_block( $block = array() )
    {
        if ( ! is_array($block))
            return '';
        
        if ( ! is_numeric($block['id']))
            return '';
        
        $form_id = $block['id'];
        
        // check if form is already on the page
        if (in_array($form_id, $this->forms))
            return '<div class="forms_block" style="padding:5px; color:#fff; background-color:#870217">Form ' . $form_id . ' is already in use on this page. Only one instance of a form is allowed on the page.</div>';
        else
            $this->forms[] = $form_id;
        
        
        // build the url to submit the form to
        //$this->submitted = false;
        //return $this->_parse_url($form_id);
        
        
        // if $_POST['submit'] matches the forms name then it was submitted
        $name = 'form' . $form_id;
        $submit = load_core('input')->post('submit');
        $this->submitted = ($submit == $name) ? true : false;
        
        // build the form
        return $this->_build_form($form_id, $this->submitted);
    }
    
    
    /*
    // check the query string to tell if this form has been submitted
    // a url like "/contact?form=2" means that form 2 has been submitted
    private function _parse_url( $form_id = 0 )
    {
        $query = array();
        $request_uri = $_SERVER['REQUEST_URI'];
        
        // is there a query string
        $position = strrpos($request_uri, "?");
        if ($position !== FALSE)
        {
            // get query string from url
            $query_str = substr($request_uri, ($position + 1));
            parse_str($query_str, $query);
            
            // check if this form has been submitted
            if ( array_key_exists('form', $query) )
            {
                if ($query['form'] == $form_id)
                    $this->submitted = true;
                else
                    $query['form'] = $form_id;
            }
            else
            {
                $query['form'] = $form_id;
            }
            
            // get url without query string
            $request_uri = substr($request_uri, 0, $position);
        }
        
        // rebuild the query string
        $query = http_build_query($query);
        
        // add the query back onto the url
        $action = $request_uri . '?' . ($query == '' ? 'form=' . $form_id : $query);
        
        // build the form
        return $this->_build_form($form_id, $action, $this->submitted);
    }
    */
    
    
    // build the form
    //private function _build_form( $id = 0, $action = '', $validate = false )
    private function _build_form( $id = 0, $validate = false )
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
        
        
        // build the data array
        $data = array();
        $data['type']      = $form['type'];
        //$data['action']    = $action;
        $data['fields']    = join('', $fields);
        $data['content']   = $form['content'];
        $data['submitted'] = $this->submitted;
        
        // the anchor link
        $data['name'] = 'form' . $form['id'];
        $data['action']    = $_SERVER['REQUEST_URI'] . '#' . $data['name'];
        
        // add css
        $this->_add_css();
        
        // load view
        return load_view('forms.default.php', $data);
    }
    
    
    private function _add_css()
    {
        $css = '/skins/' . APP . '/' . $this->registry->skin . '/css/forms.css';
        $this->registry->add_css_by_url($css);
    }
        
    
    
    /***** FORM FIELDS & TEXT ELEMENTS *****/
    
    public function get_field( $arr = array(), $validate = false )
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
                        $selected = ($option == $value) ? ' selected="selected"' : '';
                        $html .= '<option value="' . $option . '"' . $selected . '>' . $option . '</option>';
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