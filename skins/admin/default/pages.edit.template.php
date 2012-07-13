    
    <div class="admin_content">
        <h3>Pages</h3>
        <p>Nulla consectetur metus id leo egestas rutrum. Maecenas suscipit cursus leo at pulvinar.</p>
    </div>
    
    <div class="pages_edit">
    
        <form id="form2" action="/admin/pages/edit/<?= $id; ?>/update" method="post">
            
            <div class="input_heading">Edit Page</div>
            
            <div class="input_container">
                <label class="form_label">Name</label>
                <div class="form_field">
                    <input type="text" value="">
                </div>
            </div>
            
            <div class="input_container">
                <label class="form_label">URL</label>
                <div class="form_field">
                    <input type="text" value="<?= $name; ?>">
                </div>
            </div>
            
            <div class="input_container">
                <label class="form_label">Content</label>
                <div class="form_field">
                    <textarea><?= $content; ?></textarea>
                </div>
            </div>
            
            <div class="input_container">
                <label class="form_label">Meta Title</label>
                <div class="form_field">
                    <input type="text" value="<?= $meta_title; ?>">
                </div>
            </div>
            
            <div class="input_container">
                <label class="form_label">Meta Keywords</label>
                <div class="form_field">
                    <input type="text" value="<?= $meta_keywords; ?>">
                </div>
            </div>
            
            <div class="input_container">
                <label class="form_label">Meta Description</label>
                <div class="form_field">
                    <textarea><?= $meta_description; ?></textarea>
                </div>
            </div>
            
            
            <div class="form_actions">
                <button type="submit" class="btn">Update</button>
            </div>
        </form>
    </div>
    