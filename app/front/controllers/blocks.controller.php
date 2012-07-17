<?php

class blocks extends controller 
{
    
    public function get_block( $id = 0 )
    {
        if ( ! is_numeric($id)) return '';
        
        // get block info
        $blocks_model = load_model('blocks');
        //$data = $blocks_model->get_block($id);
        $data = $blocks_model->get_block_from_id($id);
        
        // if blog not found
        if ( ! count($data)) return '';
        
        // the default template
        $default = 'blocks.default.block.php';
        
        // if using custom template
        if ($data['skin'] != '')
        {
            // load the custom template
            $template = 'blocks.' . $data['skin'] . '.block.php';
            return load_view($template, $data, $default);
        }
        
        // load the default template
        return load_view($default, $data);
    }
    
}