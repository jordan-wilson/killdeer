    
    <div class="admin_content">
        <h3>Pages</h3>
        <p>Nulla consectetur metus id leo egestas rutrum. Maecenas suscipit cursus leo at pulvinar.</p>
    </div>
    
    <div class="pages_edit">
    
        <form action="/admin/pages/update_info/<?= $id; ?>" method="post">
            
            <div class="input_heading">Edit Page</div>
            
            <input type="hidden" name="id" value="<?= $id; ?>">
            
            <div class="input_container">
                <label class="form_label">Name</label>
                <div class="form_field">
                    <input type="text" name="name" value="<?= $name; ?>">
                </div>
            </div>
            
            <div class="input_container">
                <label class="form_label">URL</label>
                <div class="form_field">
                    <input type="text" name="url" value="<?= $url; ?>">
                </div>
            </div>
            
            <div class="input_container">
                <label class="form_label">Content</label>
                <div class="form_field">
                    <textarea name="content"><?= $content; ?></textarea>
                </div>
            </div>
            
            <div class="input_container">
                <label class="form_label">Meta Title</label>
                <div class="form_field">
                    <input type="text" name="meta_title" value="<?= $meta_title; ?>">
                </div>
            </div>
            
            <div class="input_container">
                <label class="form_label">Meta Keywords</label>
                <div class="form_field">
                    <input type="text" name="meta_keywords" value="<?= $meta_keywords; ?>">
                </div>
            </div>
            
            <div class="input_container">
                <label class="form_label">Meta Description</label>
                <div class="form_field">
                    <textarea name="meta_description"><?= $meta_description; ?></textarea>
                </div>
            </div>
            
            
            <div class="form_actions">
                <button type="submit" class="btn">Update</button>
            </div>
        </form>
    </div>
    