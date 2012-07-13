    
    <div id="main">
        <div id="main_content">
            
            <div class="row">
                
                <div class="span2">
                    <?= parse_cell($layout, 1); // cell 1 ?>
                </div>
                
                <div class="span7">
                    <?= parse_cell($layout, 2, true); // cell 2: content ?>
                </div>
                
                <div class="span3">
                    <?= parse_cell($layout, 3); // cell 3 ?>
                </div>
                
            </div>
            
        </div>
    </div>
    