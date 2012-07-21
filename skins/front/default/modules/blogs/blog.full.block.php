
    <?php if ( count($blog) ) : ?>
        
        <div class="blogs_blog_full">
            <h3><?= $blog['name']; ?></h3>
            <p><?= date('M d, Y', $blog['date']); ?></p>
            <p><?= $blog['content']; ?></p>
            <p><a href="/<?= $registry->modules['blogs'] . '/' . $blog['url']; ?>">go there now...</a></p>
        </div>
        
    <?php endif; ?>
    