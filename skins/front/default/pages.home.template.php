    
    <?php /*echo printr(get_defined_vars());*/ ?> 
    
    <div class="row">
        
        <div class="span8">
            <?= parse_content(); ?>
            <?= parse_cell(1); // cell 1 ?>
        </div>
        
        <div class="span4">
            <?= parse_cell(2); // cell 2 ?>
        </div>
        
    </div>
    
    <div class="row">
    
        <div class="span3">
            <?= parse_cell(3); // cell 3 ?>
        </div>
        
        <div class="span3">
            <?= parse_cell(4); // cell 4 ?>
        </div>
        
        <div class="span3">
            <?= parse_cell(5); // cell 5 ?>
        </div>
        
        <div class="span3">
            <?= parse_cell(6); // cell 6 ?>
        </div>
        
    </div>
    
    <div class="row">
    
        <div class="span12">
            <?= parse_cell(7); // cell 7 ?>
        </div>
        
    </div>
