<?php

class forms extends controller 
{
    
    public function index( $data = array() )
    {
        $request = $this->registry->request_args;
        if ( ! count($request))
            return false;
        
        $url = $request[0];
        $action = count($request) > 1 ? array_pop($request) : false;
        
        
        // if submitted
        if ($action == 'submit')
        {
            if ($this->validate($data['form_id']))
            {
                $data['content'] = '<p>You just submitted the form.</p>';
                return $data;
            }
        }
        
        
        // display the form
        $data['content'] .= $this->display($data['form_id'], $url);
        return $data;
    }
    
    
    public function validate( $id = 0 )
    {
        return true;
    }
    
    
    public function display( $id = 0, $url = '' )
    {
        // get form
        $forms_model = load_model('forms');
        $form = $forms_model->get_form($id);
        
        // if no form was found
        if ( ! $form)
            return false;
        
        // if no form fields
        if ( ! count($form['fields']))
            return false;
        
        // process each form field
        $fields = array();
        foreach($form['fields'] AS $field)
        {
            $fields[] = $this->get_field($field);
        }
        $fields = array_filter($fields);
        
        // if no form fields
        if ( ! count($fields))
            return false;
        
        
        // add css
        $this->add_css();
        
        
        // build the form
        $html = '<form action="/' . $url . '/submit" method="post">';
            $html .= join('', $fields);
            $html .= '<div class="form-actions">';
                $html .= '<button type="submit" class="btn">Submit</button>';
            $html .= '</div>';
        $html .= '</form>';
        
        return $html;
    }
    
    
    private function add_css()
    {
        $css = '/skins/' . APP . '/' . $this->registry->skin . '/css/forms.css';
        $this->registry->add_css_by_url($css);
    }
    
    
    public function get_field( $arr = array() )
    {
        $html = '';
        
        switch($arr['type'])
        {
            case 'text_input':
                $html .= $this->get_field_label($arr['id'], $arr['label']);
                $html .= '<div class="controls">';
                    $html .= '<input type="text" id="field_' . $arr['id'] . '" name="field_' . $arr['id'] . '" value="" />';
                $html .= '</div>';
                break;
            
            case 'textarea':
                $html .= $this->get_field_label($arr['id'], $arr['label']);
                $html .= '<div class="controls">';
                    $html .= '<textarea id="field_' . $arr['id'] . '" name="field_' . $arr['id'] . '"></textarea>';
                $html .= '</div>';
                break;
            
            case 'select':
                $html .= $this->get_field_label($arr['id'], $arr['label']);
                $html .= '<div class="controls">';
                    $html .= '<select id="field_' . $arr['id'] . '" name="field_' . $arr['id'] . '">';
                        foreach($arr['options'] AS $option)
                        {
                            $html .= '<option value="' . $option . '">' . $option . '</option>';
                        }
                    $html .= '</select>';
                $html .= '</div>';
                break;
            
            default:
                return false;
        }
        
        return '<div class="control-group">' . $html . '</div>';
    }
    
    
    private function get_field_label( $id = 0, $label = null )
    {
        if (trim($label))
            return '<label class="control-label" for="field_' . $id . '">' . $label . '</label>';
        
        return '';
    }
    
    
}