            
    <div class="row">
        
        <div class="span9">
        
            <div class="row">
            
                <div class="span2">
                    <div class="blogs_social">
                        <p>Facebook Like</p>
                        <p>Twitter Retweet</p>
                        <p>Google Plus</p>
                    </div>
                </div>
                
                <div class="span7">
                
                    <?= parse_cell('append_content'); ?>
                    
                    <?php if ( count($blog) ) : ?>
                        
                        <div class="blogs_view">
                            <div class="blogs_post">
                                
                                <div class="blogs_post_name">
                                    <h2><?= $blog['name']; ?></h2>
                                </div>
                                
                                <div class="blogs_post_date">
                                    <?= date('M d, Y', $blog['date']); ?> 
                                </div>
                                
                                <div class="blogs_post_content">
                                    <?= $blog['content']; ?>
                                </div>
                            </div>
                            
                            <?= debuggery('content'); ?>
                        </div>
                        
                    <?php endif; ?>
                    
                    <?= parse_cell('append_blog_content'); ?>
                    
                </div>
                
            </div>
            
            <div class="row">
            
                <div class="span9">
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
            <?= parse_cell('right_column_blog_callouts'); ?>
            <?= parse_cell('right_column_callouts'); ?>
            <?= parse_block('[blogs:recent]'); ?>
        </div>
        
    </div>
