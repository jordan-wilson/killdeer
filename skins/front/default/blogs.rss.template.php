<rss version="2.0">
    <channel>
        <title><![CDATA[<?= $rss_title; ?>]]></title>
        <link><?= $site_url; ?></link>
        <description><![CDATA[<?= $rss_description; ?>]]></description>
        <language>en-us</language>
        <pubDate><?= date('D, d M Y H:i:s T'); ?></pubDate>
        <?php foreach( $blogs AS $blog ) : ?>
            <item>
                <title><![CDATA[<?= $blog['name']; ?>]]></title>
                <description><![CDATA[<?= $blog['content']; ?>]]></description>
                <link><?= $site_url . $registry->modules['blogs'] . '/' . $blog['url']; ?></link>
                <pubDate><?= date('D, d M Y H:i:s T', $blog['date']); ?></pubDate>
            </item>
        <?php endforeach; ?>
    </channel>
</rss>