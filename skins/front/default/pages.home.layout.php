    
    <div id="main">
        <div id="main_content">
            
            <div class="row">
                
                <div class="span8"><!-- cell 1 -->
                    
                    <?php if ($layout['cells'][1]) : ?>
                        <?php foreach( $layout['cells'][1] as $block ) : ?>
                            <?= $block; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>&nbsp;</p>
                    <?php endif; ?>
                    
                </div>
                
                <div class="span4"><!-- cell 2 -->
                    <?php if ($layout['cells'][2]) : ?>
                        <?php foreach( $layout['cells'][2] as $block ) : ?>
                            <?= $block; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>&nbsp;</p>
                    <?php endif; ?>
                </div>
                
            </div>
            
            <div class="row">
            
                <div class="span3"><!-- cell 3 -->
                    <?php if ($layout['cells'][3]) : ?>
                        <?php foreach( $layout['cells'][3] as $block ) : ?>
                            <?= $block; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>&nbsp;</p>
                    <?php endif; ?>
                </div>
                
                <div class="span3"><!-- cell 4 -->
                    <?php if ($layout['cells'][4]) : ?>
                        <?php foreach( $layout['cells'][4] as $block ) : ?>
                            <?= $block; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>&nbsp;</p>
                    <?php endif; ?>
                </div>
                
                <div class="span3"><!-- cell 5 -->
                    <?php if ($layout['cells'][5]) : ?>
                        <?php foreach( $layout['cells'][5] as $block ) : ?>
                            <?= $block; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>&nbsp;</p>
                    <?php endif; ?>
                </div>
                
                <div class="span3"><!-- cell 6 -->
                    <?php if ($layout['cells'][6]) : ?>
                        <?php foreach( $layout['cells'][6] as $block ) : ?>
                            <?= $block; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>&nbsp;</p>
                    <?php endif; ?>
                </div>
                
            </div>
            
            <div class="row">
            
                <div class="span12"><!-- cell 7 -->
                    <?php if ($layout['cells'][7]) : ?>
                        <?php foreach( $layout['cells'][7] as $block ) : ?>
                            <?= $block; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>&nbsp;</p>
                    <?php endif; ?>
                </div>
                
            </div>
            
        </div>
    </div>
    