    
    <div class="pages_layout">
        
        <?php if ($xml) : ?>

            <!-- output the grid layout using the xml data -->
            <div class="layout_container">
                <h3><?= $xml->name; ?></h3>
                <p><?= $xml->notes; ?></p>
            
                <?php
                    
                    $i = 0;
                    $rows = $xml->rows;
                    foreach ($rows->row as $row)
                    {
                        // row
                        echo '<div class="row">';
                        
                            foreach ($row as $cell)
                            {
                                // compile block data into an array to check if certain blocks need rules applied
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
                
                ?>
            </div>
            
        <?php else: ?>
            <p>no layouts xml</p>
        <?php endif; ?>
        
    </div>
    