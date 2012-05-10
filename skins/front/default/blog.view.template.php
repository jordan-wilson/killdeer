    
    <div class="row">
        
        <div class="span8">
            <h1><?= $registry->page_heading; ?></h1>
            
            <?php if ( count($blog) ) : ?>
                
                <div class="blog_post">
                    <div class="blog_date">
                        <?= date('M d, Y', $blog['date']); ?> 
                    </div>
                    
                    <div class="blog_name">
                        <?= $blog['name']; ?> 
                    </div>
                    
                    <div class="blog_content">
                        <?= $blog['content']; ?> 
                    </div>
                </div>
                
            <?php endif; ?>
        </div>
        
        <div class="span4">
            <p>Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Vestibulum id ligula porta felis euismod semper. Donec id elit non mi porta gravida at eget metus.</p>
        </div>
        
    </div>
