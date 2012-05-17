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
            <?php if ($layout['cells'][1]) : ?>
                <?php foreach( $layout['cells'][1] as $block ) : ?>
                    <?= $block; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <?= (count($registry->js) ? join("\n", $registry->js) : ''); ?> 
    </body>
</html>