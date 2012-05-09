    
    <div class="row">
        
        <div class="span8">
            <h1><?= $header; ?></h1>
            <p><?= $content; ?></p>
            <?php /*echo '<pre>' . print_r(get_defined_vars(), true) . '</pre>';*/ ?> 
            <?php if ( count($blogs) ) : ?>
            
                <?php foreach( $blogs AS $idx => $blog ) : ?>
                
                    <div class="blog_post<?= ($idx == 0 ? ' blog_post_first' : ''); ?>">
                        <div class="blog_date">
                            <?= date('M d, Y', $blog['date']); ?> 
                        </div>
                        
                        <div class="blog_name">
                            <?= $blog['name']; ?> 
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
        </div>
        
        <div class="span4">
            <p>Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Vestibulum id ligula porta felis euismod semper. Donec id elit non mi porta gravida at eget metus.</p>
        </div>
        
    </div>
