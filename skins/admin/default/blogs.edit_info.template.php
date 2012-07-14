    
    <div class="admin_content">
        <h3>Blogs</h3>
        <p>Morbi a est lorem sed eleifend justo. Etiam scelerisque tincidunt pretium. Etiam eu velit sapien.</p>
    </div>
    
    <div class="blogs_edit">
    
        <form action="/admin/blogs/update_info/<?= $id; ?>" method="post">
            
            <div class="input_heading">Edit Blog</div>
            
            <input type="hidden" name="id" value="<?= $id; ?>">
            
            <div class="input_container">
                <label class="form_label">Name</label>
                <div class="form_field">
                    <input type="text" name="name" value="<?= $name; ?>">
                </div>
            </div>
            
            <div class="input_container">
                <label class="form_label">Date</label>
                <div class="form_field">
                    <input type="text" name="date" value="<?= $date; ?>">
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
    