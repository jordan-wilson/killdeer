    
    <div class="admin_content">
        <h3>Blogs</h3>
        <p>Morbi a est lorem sed eleifend justo. Etiam scelerisque tincidunt pretium. Etiam eu velit sapien.</p>
    </div>
    
    <div class="blogs_edit">
        <table class="blogs_edit_table">
            <tr>
                <td>ID</td>
                <td><?= $id; ?></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><?= $name; ?></td>
            </tr>
            <tr>
                <td>URL</td>
                <td><?= $url; ?></td>
            </tr>
            <tr>
                <td>Date</td>
                <td><?= date('M d, Y', $date); ?></td>
            </tr>
            <tr>
                <td>Content</td>
                <td><?= $content; ?></td>
            </tr>
            <tr>
                <td>Meta Title</td>
                <td><?= $meta_title; ?></td>
            </tr>
            <tr>
                <td>Meta Keywords</td>
                <td><?= $meta_keywords; ?></td>
            </tr>
            <tr>
                <td>Meta Description</td>
                <td><?= $meta_description; ?></td>
            </tr>
            <tr>
                <td>Layout</td>
                <td><?= $layout; ?></td>
            </tr>
        </table>
    </div>
    