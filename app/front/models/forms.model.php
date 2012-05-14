<?php

class forms_model extends model
{
    
    public function get_form( $id = 0 )
    {
        switch($id)
        {
            case 1:
                $arr = array(
                    'id' => 1,
                    'name' => 'Contact Us',
                    'type' => 'horizontal',
                    'content' => '<p>Thank you for filling out our contact form.</p>',
                    'fields' => array(
                        array('id' => 1, 'required' => 1, 'label' => 'Name', 'type' => 'text_input'),
                        array('id' => 2, 'required' => 0, 'label' => 'Email', 'type' => 'text_input'),
                        array('id' => 3, 'required' => 1, 'label' => 'Some options', 'type' => 'select', 'options' => array('option 1', 'option 2', 'option 3')),
                        array('id' => 4, 'required' => 1, 'label' => 'Questions / Comments', 'type' => 'textarea')
                    )
                );
                return $arr;
                break;
            
            case 2:
                $arr = array(
                    'id' => 2,
                    'name' => 'Newsletter',
                    'type' => '',
                    'content' => '<p>Thanks for signing up for the newsletter.</p>',
                    'fields' => array(
                        array('id' => 5, 'required' => 1, 'label' => 'Name', 'type' => 'text_input'),
                        array('id' => 6, 'required' => 1, 'label' => 'Email', 'type' => 'text_input'),
                    )
                );
                return $arr;
                break;
        }
        
        return false;
    }

}