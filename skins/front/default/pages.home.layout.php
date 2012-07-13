    
    <div id="main">
        <div id="main_content">
            
            <div class="row">
                
                <div class="span8">
                    <?= parse_cell($layout, 1, true); // cell 1: content ?>
                </div>
                
                <div class="span4">
                    <?= parse_cell($layout, 2); // cell 2 ?>
                </div>
                
            </div>
            
            <div class="row">
            
                <div class="span3">
                    <?= parse_cell($layout, 3); // cell 3 ?>
                </div>
                
                <div class="span3">
                    <?= parse_cell($layout, 4); // cell 4 ?>
                </div>
                
                <div class="span3">
                    <?= parse_cell($layout, 5); // cell 5 ?>
                </div>
                
                <div class="span3">
                    <?= parse_cell($layout, 6); // cell 6 ?>
                </div>
                
            </div>
            
            <div class="row">
            
                <div class="span12">
                    <?= parse_cell($layout, 7); // cell 7 ?>
                </div>
                
            </div>
            
        </div>
    </div>
    