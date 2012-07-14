            
            <div id="footer">
                <div id="footer_content">
                    <ul>
                        <li><a href="/admin/">Dashboard</a></li>
                        <li><a href="/admin/pages">Pages</a></li>
                        <li><a href="/admin/blogs">Blogs</a></li>
                        <li><a href="/admin/layouts">Layouts</a></li>
                    </ul>
                </div>
            </div>
            
        </div>
        
        <!--script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script-->
        <script>window.jQuery || document.write('<script src="/lib/jquery-1.7.2.min.js"><\/script>')</script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
        <?= (count($registry->js) ? join("\n", $registry->js) : ''); ?> 
        
    </body>
</html>