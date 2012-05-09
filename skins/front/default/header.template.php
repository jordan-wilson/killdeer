<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?= $registry->meta_title; ?></title>
        <meta name="keywords" content="<?= $registry->meta_keywords; ?>">
        <meta name="description" content="<?= $registry->meta_description; ?>">
        
        <?= (count($registry->css) ? join("\n", $registry->css) : ''); ?> 
        <link rel="stylesheet" href="/skins/front/default/css/style.css" media="all" /> 
    </head>
    <body>
    
        <div id="container">
        
            <div id="header">
                <div id="header_content">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/about">About</a></li>
                        <li><a href="/blog">Blog</a></li>
                    </ul>
                </div>
            </div>
        
            <div id="main">
                <div id="main_content">
                