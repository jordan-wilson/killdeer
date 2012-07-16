    
    <div class="admin_content">
        <h3>Blocks</h3>
        <p>Metus id leo egestas rutrum maecenas suscipit cursus leo at pulvinar.</p>
    </div>
    
    <div class="blocks_index">
        
        <?php if (count($blocks)) : ?>
            
            <table class="index_table blocks_index_table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Skin</th>
                        <th width="50px"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($blocks as $block) : ?>
                
                        <tr>
                            <td><?= $block['name']; ?></td>
                            <td>
                                <?php if (array_key_exists($block['skin'], $skins)) : ?>
                                    <?= $skins[$block['skin']]; ?>
                                <?php endif; ?>
                            </td>
                            <td><a href="/admin/blocks/edit_info/<?= $block['id']; ?>">Edit</a></td>
                        </tr>
                    
                    <?php endforeach; ?>
                </tbody>
            </table>
            
        <?php endif; ?>
        
    </div>
    