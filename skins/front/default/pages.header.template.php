<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?= $registry->meta_title; ?></title>
        <meta name="keywords" content="<?= $registry->meta_keywords; ?>">
        <meta name="description" content="<?= $registry->meta_description; ?>">
        
        <?= (count($registry->css) ? join("\n", $registry->css) : ''); ?> 
        <link rel="stylesheet" href="/skins/front/default/css/grid.css" media="all" /> 
        <link rel="stylesheet" href="/skins/front/default/css/style.css" media="all" /> 
        <link rel="stylesheet" href="/skins/front/default/css/content.css" media="all" /> 
    </head>
    <body>
    
        <div id="container">
        
            <div id="header">
                <div id="header_content">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/about">About</a></li>
                        <li><a href="/blog">Blog</a></li>
                        <li><a href="/contact">Contact</a></li>
                    </ul>
                </div>
            </div>
            