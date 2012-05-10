<?php

class forms_model extends model
{
    
    public function get_form( $id = 0 )
    {
        switch($id)
        {
            case 1:
                $arr = array(
                    'name' => 'Contact Us',
                    'content' => '<p>Thank you for filling out our contact form.</p>',
                    'fields' => array(
                        array('id' => 1, 'label' => 'Name', 'type' => 'text_input'),
                        array('id' => 2, 'label' => 'Email', 'type' => 'text_input'),
                        array('id' => 3, 'label' => 'Some options', 'type' => 'select', 'options' => array('option 1', 'option 2', 'option 3')),
                        array('id' => 4, 'label' => 'Questions / Comments', 'type' => 'textarea')
                    )
                );
                return $arr;
                break;
        }
        
        return false;
    }

}