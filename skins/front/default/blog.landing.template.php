    
    <?php if ( count($blogs) ) : ?>
    
        <?php foreach( $blogs AS $idx => $blog ) : ?>
        
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
                
                <div class="blog_link">
                    <a href="<?= $url . '/' . $blog['url']; ?>">read more</a>
                </div>
            </div>
            
        <?php endforeach; ?>
    
    <?php else: ?>
        <p>No blogs have been posted yet.</p>
    <?php endif; ?>
    