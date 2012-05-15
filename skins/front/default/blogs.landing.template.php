    
    <?php if ( count($blogs) ) : ?>
    
        <div class="blogs_landing">
            <?php foreach( $blogs AS $idx => $blog ) : ?>
            
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
                    
                    <div class="blogs_post_link">
                        <a href="<?= $url . '/' . $blog['url']; ?>">read more</a>
                    </div>
                </div>
                
            <?php endforeach; ?>
        </div>
    
    <?php else: ?>
        <p>No blogs have been posted yet.</p>
    <?php endif; ?>
    