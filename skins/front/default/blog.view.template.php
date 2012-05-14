    
    <?php if ( count($blog) ) : ?>
        
        <div class="blog_post">
            
            <div class="blog_name">
                <h2><?= $blog['name']; ?></h2>
            </div>
            
            <div class="blog_date">
                <?= date('M d, Y', $blog['date']); ?> 
            </div>
            
            <div class="blog_content">
                <?= $blog['content']; ?> 
            </div>
        </div>
        
    <?php endif; ?>
    