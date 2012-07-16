    
    <div class="admin_content">
        <h3>Blocks</h3>
        <p>Metus id leo egestas rutrum maecenas suscipit cursus leo at pulvinar.</p>
    </div>
    
    <div class="blocks_edit">
    
        <form action="/admin/blocks/update_info/<?= $id; ?>" method="post">
            
            <div class="input_heading">Edit Block</div>
            
            <input type="hidden" name="id" value="<?= $id; ?>">
            
            <div class="input_container">
                <label class="form_label">Name</label>
                <div class="form_field">
                    <input type="text" name="name" value="<?= $name; ?>">
                </div>
            </div>
            
            <div class="input_container">
                <label class="form_label">Title</label>
                <div class="form_field">
                    <input type="text" name="title" value="<?= $title; ?>">
                </div>
            </div>
            
            <?php if (count($skins)) : ?>
                <div class="input_container">
                    <label class="form_label">Skin "/skin/front/default/layouts/blocks.xml"</label>
                    <div class="form_field">
                        <?php /*<input type="text" name="skin" value="<?= $skin; ?>">*/ ?>
                        <select name="skin">
                            <option value=""></option>
                            <?php foreach( $skins as $key => $val ) : ?>
                                <option value="<?= $key; ?>"<?= ($skin == $key ? ' selected="selected"' : ''); ?>>
                                    <?= $val ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            <?php else : ?>
                <input type="hidden" name="skin" value="">
            <?php endif; ?>
            
            
            <div class="input_container">
                <label class="form_label">Content</label>
                <div class="form_field">
                    <textarea name="content"><?= $content; ?></textarea>
                </div>
            </div>
            
            
            <div class="form_actions">
                <button type="submit" class="btn">Update</button>
            </div>
        </form>
    </div>
    