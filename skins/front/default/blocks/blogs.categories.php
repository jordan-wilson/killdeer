
    <?php if ( count($categories) ) : ?>
    
        <div class="blogs_categories_block">
            <h3>Blog Categories</h3>
            <ul>
                <?php foreach( $categories as $category ) : ?>
                    <li>
                        <a href="<?= $registry->modules['blogs'] . '/' . 'category/' . $category['url']; ?>">
                            <?= $category['name']; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>   
        </div>
        
    <?php endif; ?>
