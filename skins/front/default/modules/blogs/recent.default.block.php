    
    <?php if ( count($blogs) ) : ?>
    
        <div class="blogs_recent_block">
            <h3>Recent Blogs</h3>
            <ul>
                <?php foreach( $blogs AS $idx => $blog ) : ?>
                    <li>
                        <a href="/<?= $registry->modules['blogs'] . '/' . $blog['url']; ?>">
                            <?= $blog['name']; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    
    <?php endif; ?>
    