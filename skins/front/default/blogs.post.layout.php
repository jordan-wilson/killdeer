    
    <div id="main">
        <div id="main_content">
            
            <div class="row">
                
                <div class="span2"><!-- cell 1 -->
                    
                    <?php if ($layout['cells'][1]) : ?>
                        <?php foreach( $layout['cells'][1] as $block ) : ?>
                            <?= $block; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>&nbsp;</p>
                    <?php endif; ?>
                    
                </div>
                
                <div class="span7"><!-- cell 2 -->
                    
                    <?php if ($layout['cells'][2]) : ?>
                        <?php foreach( $layout['cells'][2] as $block ) : ?>
                            <?= $block; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>&nbsp;</p>
                    <?php endif; ?>
                    
                </div>
                
                <div class="span3"><!-- cell 3 -->
                    <?php if ($layout['cells'][3]) : ?>
                        <?php foreach( $layout['cells'][3] as $block ) : ?>
                            <?= $block; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>&nbsp;</p>
                    <?php endif; ?>
                </div>
                
            </div>
            
        </div>
    </div>
    