<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?= $registry->meta_title; ?></title>
        <meta name="keywords" content="<?= $registry->meta_keywords; ?>">
        <meta name="description" content="<?= $registry->meta_description; ?>">
        
        <?= (count($registry->css) ? join("\n", $registry->css) : ''); ?> 
    </head>
    <body>
    
        <div>
            <?= $content; ?>
        </div>
        
        <?= (count($registry->js) ? join("\n", $registry->js) : ''); ?> 
    </body>
</html>