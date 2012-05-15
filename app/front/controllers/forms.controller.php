<?php

class forms extends controller 
{
    
    private $submitted;
    private $forms = array();
    
    public function get_block( $id = 0 )
    {
        // check if form is unique
        if (in_array($id, $this->forms)) return '<p>FORM ' . $id . ' IS ALREADY IN USE ON THIS PAGE. YOU CANNOT HAVE MULTIPLE INSTANCES OF A FORM ON A SINGLE PAGE AT ONE TIME.</p>';
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
                return $this->build_form($id, $url, true);
            }
        }
        
        // return the form
        return $this->build_form($id, $url);
    }
    
    
    public function build_form( $id = 0, $url = '', $validate = false )
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
        $this->add_css();
        
        
        // the forms classname
        switch($form['type'])
        {
            case 'horizontal':
                $class = 'class="form_horizontal"';
                break;
            default:
                $class = '';
        }
        
        // the anchor link
        $name = 'form' . $form['id'];
        
        
        $html = '';
        
        // return thank you text
        if ($this->submitted)
        {
            $html .= '<a name="' . $name . '"></a>';
            $html .= '<div class="form_submitted">';
                $html .= $form['content'];
            $html .= '</div>';
        }
        
        // else, return the form
        else
        {
            // the post url
            $action = '/' . $url . '/' . $form['id'] . '/submit#' . $name;
            
            // build the form
            $html .= '<form ' . $class . ' id="' . $name . '" action="' . $action . '" method="post">';
                $html .= join('', $fields);
                $html .= '<div class="form_actions">';
                    $html .= '<button type="submit" class="btn">Submit</button>';
                $html .= '</div>';
            $html .= '</form>';
        }
        
        return $html;
    }
    
    
    private function add_css()
    {
        $css = '/skins/' . APP . '/' . $this->registry->skin . '/css/forms.css';
        $this->registry->add_css_by_url($css);
    }
    
    
    public function get_field( $arr = array(), $validate = array() )
    {
        switch($arr['type'])
        {
            case 'text_input':
                return $this->get_text_input($arr, $validate);
                break;
            
            case 'textarea':
                return $this->get_textarea($arr, $validate);
                break;
            
            case 'select':
                return $this->get_select($arr, $validate);
                break;
        }
        return false;
    }
    
    
    // focus on first incomplete field
    private function add_input_focus( $id = '' )
    {
        if ($this->submitted)
        {
            $js = '<script>$(function () { $("#' . $id . '").focus(); });</script>';
            $this->registry->add_js($js);
        }
    }
    
    
    // label
    private function get_field_label( $id = 0, $arr = array() )
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
    private function get_text_input( $arr = array(), $validate = false )
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
                    $this->add_input_focus($id);
                    $this->submitted = false;
                }
            }
        }
        
        $html .= '<div class="input_container">';
            $html .= $this->get_field_label($id, $arr);
            $html .= '<div class="form_field">';
                $html .= '<input type="text" id="' . $id . '" name="' . $id . '" value="' . htmlentities($value) . '" />';
                $html .= $error;
            $html .= '</div>';
        $html .= '</div>';
        
        return $html;
    }
    
    
    // textarea
    private function get_textarea( $arr = array(), $validate = false )
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
                    $this->add_input_focus($id);
                    $this->submitted = false;
                }
            }
        }
        
        $html .= '<div class="input_container">';
            $html .= $this->get_field_label($id, $arr);
            $html .= '<div class="form_field">';
                $html .= '<textarea id="' . $id . '" name="' . $id . '">' . $value . '</textarea>';
                $html .= $error;
            $html .= '</div>';
        $html .= '</div>';
        
        return $html;
    }
    
    
    // select
    private function get_select( $arr = array(), $validate = false )
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
                    $this->add_input_focus($id);
                    $this->submitted = false;
                }
            }
        }
        
        $html .= '<div class="input_container">';
            $html .= $this->get_field_label($id, $arr);
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
    
    
    
}