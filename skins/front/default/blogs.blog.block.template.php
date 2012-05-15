
    <?php if ( count($blog) ) : ?>
        
        <div class="blogs_blog_block">
            <h3><?= $blog['name']; ?></h3>
            <p><?= date('M d, Y', $blog['date']); ?></p>
            <p><?= substr(strip_tags($blog['content']), 0, 100); ?>...</p>
            <p><a href="<?= $link . $blog['url']; ?>">Read on</a></p>
        </div>
        
    <?php endif; ?>
    