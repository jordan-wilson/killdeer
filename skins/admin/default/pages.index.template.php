    
    <div class="admin_content">
        <h3>Pages</h3>
        <p>Nulla consectetur metus id leo egestas rutrum. Maecenas suscipit cursus leo at pulvinar.</p>
    </div>
    
    <div class="pages_index">
        
        <?php if (count($pages)) : ?>
            
            <table class="pages_index_table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>URL</th>
                        <th width="50px"></th>
                        <th width="50px"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($pages as $page) : ?>
                
                        <tr>
                            <td><?= $page['name']; ?></td>
                            <td><?= $page['url']; ?></td>
                            <td><a href="/admin/pages/layout/<?= $page['id']; ?>">Layout</a></td>
                            <td><a href="/admin/pages/edit/<?= $page['id']; ?>">Edit</a></td>
                        </tr>
                    
                    <?php endforeach; ?>
                </tbody>
            </table>
            
        <?php endif; ?>
        
    </div>
    