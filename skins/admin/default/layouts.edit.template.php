    
    <div class="pages_layout">
        
<?php
    
    $layout_controller = ($layout['controller'] ? $layout['controller'] : 'pages' );
    $layout_skin = ($layout['skin'] ? $layout['skin'] : 'default' );
    $layout_object = null;
    
    //echo '<pre>' . print_r($layout, true) . '</pre>';
    //echo '<p>controller: ' . $layout_controller . '</p>';
    //echo '<p>skin: ' . $layout_skin . '</p>';
    
    // get the layout xml file
    $xml_file = dirname(__FILE__) . '/../../front/default/layouts/' . $layout_controller . '.xml';
    
    if (file_exists($xml_file)) 
    {
        $xml_layouts = simplexml_load_file($xml_file);
        //echo '<pre>' . print_r($xml_layouts, true) . '</pre>';
        
        foreach($xml_layouts as $idx => $xml_layout)
        {
            //echo '<pre>' . print_r($xml_layout, true) . '</pre>';
            
            //echo '<p>' . $xml_layout->controller . ' ' . $xml_layout->skin . '</p>';
            if ($xml_layout->controller == $layout_controller)
            {
                if ($xml_layout->skin == $layout_skin)
                {
                    //echo '<pre>' . print_r($xml_layout, true) . '</pre>';
                    $layout_object = $xml_layout;
                    break;
                }
            }
            
        }
    }
    else
    {
        echo '<p>file not found:<br />' . $xml_file . '</p>';
    }
    
    
    if ($layout_object)
    {
        /*
        echo '<pre>' . print_r($layout_object, true) . '</pre>';
        $layout_cells = $layout_object->cells;
        echo '<pre>' . print_r($layout_cells, true) . '</pre>';
        foreach($layout_cells->row as $layout_cells_row)
        {
            echo '<pre>' . print_r($layout_cells_row, true) . '</pre>';
            foreach($layout_cells_row as $obj)
            {
                echo '<pre>' . print_r($obj, true) . '</pre>';
                echo '<pre>' . print_r($obj->attributes(), true) . '</pre>';
            }
        }
        */
        
        // output the grid layout using the xml data
        echo '<div class="layout_container">';
            echo '<h3>' . $layout_object->name . '</h3>';
            echo '<p>' . $layout_object->notes . '</p>';
            
            $i = 0;
            $layout_cells = $layout_object->cells;
            
            foreach($layout_cells->row as $layout_cells_row)
            {
                // row
                echo '<div class="row">';
                
                    foreach($layout_cells_row as $cell)
                    {
                        // build an array to check if certain blocks have rules
                        $blocks = array();
                        foreach($cell as $block)
                        {
                            $block_value = (string)$block->attributes()->value;
                            $blocks[ $block_value ] = array(
                                'locked' => (int)$block->attributes()->locked
                            );
                        }
                        
                        $i++;
                        $cell_class = $cell->attributes()->class;
                        $cell_limit = (int)$cell->attributes()->limit;
                        $cell_protected = (int)$cell->attributes()->protected;
                        
                        // cell
                        echo '<div class="' . $cell_class . '">';
                        
                            echo '<div id="cell_' . $i . '" class="layout_cell">';
                            
                                // sortable list of blocks
                                //echo '<div class="' . ($cell_protected ? '' : 'layout_sortable_cell' . ($cell_limit ? ' layout_limit_cell_' . $cell_limit : '')) . '">';
                                echo '<div class="' . ($cell_protected ? '' : 'layout_sortable_cell' . ($cell_limit ? ' layout_limit_cell' : '')) . '">';
                                    
                                    // add hidden input with block limit
                                    echo ($cell_limit ? '<input type="hidden" name="limit" value="' . $cell_limit . '" />' : '');
                                    
                                    foreach($layout['cells'][$i] as $block)
                                    {
                                        $block_class = 'layout_block';
                                        
                                        if ($blocks[$block])
                                        {
                                            // if block is locked
                                            if ($blocks[$block]['locked'])
                                                $block_class = 'layout_block_locked';
                                        }
                                        
                                        // block
                                        echo '<div class="' . $block_class . '">';
                                            if ($block_class == 'layout_block_locked')
                                                echo '<img style="float:right" src="/skins/admin/default/images/icon-lock.png" />';
                                            echo $block;
                                        echo '</div>';
                                    }
                                    
                                echo '</div>';
                                
                                
                                // if block protected
                                if ($cell_protected)
                                {
                                    // show new blocks are disabled
                                    echo '<div class="layout_block_add_disabled">';
                                        echo '<a onclick="return false">LOCKED</a>';
                                    echo '</div>';
                                }
                                else
                                {
                                    // add new block button
                                    echo '<div class="layout_block_add">';
                                        echo '<a onclick="return false">ADD BLOCK</a>';
                                    echo '</div>';
                                }
                                    
                            echo '</div>';
                        echo '</div>';
                    }
                    
                echo '</div>';
            }
            
        echo '</div>';
    }
    else
    {
        echo 'no layouts object';
    }

?>
        
    </div>
    