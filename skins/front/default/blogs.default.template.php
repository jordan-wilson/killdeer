    
    <?php /*echo printr(get_defined_vars());*/ ?> 

    <div class="row">
        
        <div class="span9">
        
            <?= parse_content(); ?>
            <?= parse_cell(1); // cell 1 ?>
            
            <?php if ( count($blogs) ) : ?>
            
                <div class="blogs_landing">
                    <?php foreach( $blogs AS $idx => $blog ) : ?>
                    
                        <div class="blogs_post">
                            
                            <div class="blogs_post_name">
                                <h2><?= $blog['id'] . ' ' . $blog['name']; ?></h2>
                            </div>
                            
                            <div class="blogs_post_date">
                                <?= date('M d, Y', $blog['date']); ?> 
                            </div>
                            
                            <div class="blogs_post_content">
                                <?= $blog['content']; ?> 
                            </div>
                            
                            <div class="blogs_post_link">
                                <a href="<?= $registry->page_data['url'] . '/' . $blog['url']; ?>">read more</a>
                            </div>
                        </div>
                        
                    <?php endforeach; ?>
                </div>
                
                <?php if ( $older_page != '' || $newer_page != '' ) : ?>
                    <div class="blogs_paginate">
                        
                        <?php if ( $older_page != '' ) : ?>
                            <div class="blogs_paginate_older">
                                <a href="<?= $older_page; ?>">Older Post</a>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ( $newer_page != '' ) : ?>
                            <div class="blogs_paginate_newer">
                                <a href="<?= $newer_page; ?>">Newer Post</a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="clear"></div>
                    </div>
                <?php endif; ?>
            
            <?php else: ?>
                <p>template: No blogs have been posted yet.</p>
            <?php endif; ?>


        </div>
        
        <div class="span3">
            <?= parse_block('[blogs:subscribe]'); ?>
            <?= parse_block('[blogs:categories]'); ?>
            <?= parse_cell(2); // cell 2 ?>
            <?= parse_block('[blogs:recent]'); ?>
        </div>
        
    </div>
