    
    <div id="main">
        <div id="main_content">
            
            <div class="row">
                
                <div class="span9">
                    <?= parse_cell($layout, 1, true); // cell 1: content ?>
                </div>
                
                <div class="span3">
                    <?= parse_block('[blogs:subscribe]'); ?>
                    <?= parse_block('[blogs:categories]'); ?>
                    <?= parse_cell($layout, 2); // cell 2 ?>
                    <?= parse_block('[blogs:recent]'); ?>
                </div>
                
            </div>
            
        </div>
    </div>
    