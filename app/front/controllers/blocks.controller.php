<?php

class blocks extends controller 
{
    
    // get custom block
    public function get_block( $block = array() )
    {
        if ( ! is_array($block))
            return '';
        
        if ( ! is_numeric($block['id']) )
            return '';
        
        // get block info
        $blocks_model = load_model('blocks');
        $data = $blocks_model->get_block_from_id( $block['id'] );
        
        // if block not found
        if ( ! count($data))
            return '';
        
        // the default template
        $default = 'blocks.default.php';
        
        // if using custom template
        if ($data['view'] != '')
        {
            // load the custom template
            $template = 'blocks.' . $data['view'] . '.php';
            return load_view($template, $data, $default);
        }
        
        // load the default template
        return load_view($default, $data);
    }
    
}