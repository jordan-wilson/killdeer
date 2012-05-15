    
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
        </div>
        
    <?php endif; ?>
    