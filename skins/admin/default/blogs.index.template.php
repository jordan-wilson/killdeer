    
    <div class="admin_content">
        <h3>Blogs</h3>
        <p>Morbi a est lorem sed eleifend justo. Etiam scelerisque tincidunt pretium. Etiam eu velit sapien.</p>
    </div>
    
    <div class="blogs_index">
        
        <?php if (count($blogs)) : ?>
            
            <table class="index_table blogs_index_table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>URL</th>
                        <th width="50px"></th>
                        <th width="50px"></th>
                    </tr>
                </thead>
                <?php foreach($blogs as $blog) : ?>
            
                    <tr>
                        <td><?= date('M d, Y', $blog['date']); ?></td>
                        <td><?= $blog['name']; ?></td>
                        <td><?= $blog['url']; ?></td>
                        <td>
                            <?php if ($blog['layout'] != 0) : ?>
                                <a href="/admin/layouts/edit/<?= $blog['layout']; ?>">Layout</a></td>
                            <?php endif; ?>
                        </td>
                        <td><a href="/admin/blogs/edit_info/<?= $blog['id']; ?>">Edit</a></td>
                    </tr>
                
                <?php endforeach; ?>
            </table>
            
        <?php endif; ?>
        
    </div>
    