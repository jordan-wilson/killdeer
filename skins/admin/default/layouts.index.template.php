    
    <div class="admin_content">
        <h3>Layouts</h3>
        <p>Maecenas suscipit cursus leo at pulvinar. Nulla consectetur metus id leo egestas rutrum</p>
    </div>
    
    <div class="layouts_index">
        
        <?php if (count($layouts)) : ?>
            
            <table class="index_table layouts_index_table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th width="50px"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($layouts as $layout) : ?>
                
                        <tr>
                            <td><?= $layout['name']; ?></td>
                            <td><a href="/admin/layouts/edit/<?= $layout['id']; ?>">Edit</a></td>
                        </tr>
                    
                    <?php endforeach; ?>
                </tbody>
            </table>
            
        <?php endif; ?>
        
    </div>
    