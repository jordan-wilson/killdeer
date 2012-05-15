            
            <div id="footer">
                <div id="footer_content">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/about">About</a></li>
                        <li><a href="/blog">Blog</a></li>
                    </ul>
                </div>
            </div>
            
        </div>
        
        
        <script src="//ajax.googleapis.com/ajax/lib/jquery/1.7.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="/lib/jquery-1.7.2.min.js"><\/script>')</script>
        <?= (count($registry->js) ? join("\n", $registry->js) : ''); ?> 
        
    </body>
</html>