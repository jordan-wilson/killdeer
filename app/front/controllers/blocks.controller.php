<?php

class blocks extends controller 
{
    
    public function get_block( $arg = '' )
    {
        if (is_numeric($arg))
        {
            // get block info
            $blocks_model = load_model('blocks');
            $data = $blocks_model->get_block($arg);
            
            if ( ! count($data)) return '';
            
            // the template to use for the block
            $template = 'blocks.default.template.php';
            if ($data['skin'] != '')
            {
                $skin = 'blocks.' . $data['skin'] . '.template.php';
                $path = SITE_ROOT . '/skins/' . APP . '/' . $this->registry->skin . '/' . $skin;
                if (file_exists($path))
                    $template = $skin;
            }
            
            // load block
            return load_view($template, $data);
        }
        
        return '';
    }
    
}