<?php

class blocks extends controller 
{
    
    // the landing page
    public function index()
    {
        // get list of blocks
        $blocks_model = load_model('blocks');
        $data['blocks'] = $blocks_model->get_blocks();
        
        // get block skins
        $data['skins'] = $this->_get_block_skins();
        
        // update content
        $this->content = load_view('blocks.index.template.php', $data);
        
        // add css
        $this->_add_css();
        
        // load layout
        $this->display();
    }
    
    
    // edit the block info
    public function edit_info()
    {
        // get block id
        $request = $this->registry->request_args;
        $id = $request[0];
        
        // get block data
        $blocks_model = load_model('blocks');
        $data = $blocks_model->get_block_from_id($id);
        
        // if data not found
        if ( ! count($data))
            error_page();
        
        // can't edit an html block
        if ( $data['skin'] == 'html' )
            error_page();
        
        // get block skins
        $data['skins'] = $this->_get_block_skins();
        
        // update content
        $this->content = load_view('blocks.edit_info.template.php', $data);
        
        // add css
        $this->_add_css();
        
        // load layout
        $this->display();
    }
    
    
    // update block info
    public function update_info()
    {
        $input = load_core('input');
        $post  = $input->post();
        
        // update block info
        $blocks_model = load_model('blocks');
        $updated = $blocks_model->update_block_info($post);
        if ($updated === false)
            echo 'There was a problem updating this block.';
        
        // return to edit info page
        $this->edit_info();
    }
    
    
    // get types of blocks
    private function _get_block_skins()
    {
        $skins = array();
        
        // get the blocks xml file
        $xml_file = SITE_ROOT . '/skins/front/default/layouts/blocks.xml';
        
        if (file_exists($xml_file)) 
        {
            $xml = simplexml_load_file($xml_file);
            //echo '<pre>' . print_r($xml, true) . '</pre>';
            
            if ($xml->blocks)
            {
                if (count($xml->blocks->block))
                {
                    foreach($xml->blocks->block as $idx => $block)
                    {
                        if ($block->skin != 'html')
                        {
                            //echo '<pre>' . print_r($block, true) . '</pre>';
                            $skin = (string) $block->skin;
                            $name = (string) $block->name;
                            $skins[ $skin ] = $name;
                        }
                    }
                }
            }
        }
        else
        {
            echo '<p>file not found:<br />' . $xml_file . '</p>';
        }
        
        return $skins;
    }
    
    
    private function _add_css()
    {
        $css = '/skins/' . APP . '/' . $this->registry->skin . '/css/blocks.css';
        $this->registry->add_css_by_url($css);
    }
    
    
    //private function _add_js()
    //{
        //$js = '/skins/' . APP . '/' . $this->registry->skin . '/js/blocks.js';
        //$this->registry->add_js_by_url($js);
    //}
    
}