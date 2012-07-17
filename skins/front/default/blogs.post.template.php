    
    <div id="main">
        <div id="main_content">
            
            <?php /*
            <div class="row">
                
                <div class="span2">
                    <p>Facebook Like</p>
                    <p>Twitter Retweet</p>
                    <p>Google Plus</p>
                </div>
                
                <div class="span7">
                    <?= parse_cell($layout, 1, true); // cell 1: content ?>
                </div>
                
                <div class="span3">
                    <?= parse_cell($layout, 2); // cell 2 ?>
                </div>
                
            </div>
            
            <div class="row">
            
                <div class="span9">
                    <div class="blogs_comments">
                        <p>blog comments here</p>
                    </div>
                </div>
                
            </div>
            */ ?>
            
            <div class="row">
                
                <div class="span9">
                
                    <div class="row">
                    
                        <div class="span3">
                            <div class="blogs_social">
                                <p>Facebook Like</p>
                                <p>Twitter Retweet</p>
                                <p>Google Plus</p>
                            </div>
                        </div>
                        
                        <div class="span9">
                            <?= parse_cell($layout, 1, true); // cell 1: content ?>
                        </div>
                        
                    </div>
                    
                    <div class="row">
                    
                        <div class="span12">
                            <div class="blogs_comments">
                                <p>Comments</p>
                                <p>Fusce dapibus tellus ac cursus commodo</p>
                                <p>tortor mauris condimentum nibh</p>
                                <p>ut fermentum massa justo sit amet risus</p>
                            </div>
                        </div>
                        
                    </div>
                    
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
    <?php /*echo printr(get_defined_vars());*/ ?> 
    