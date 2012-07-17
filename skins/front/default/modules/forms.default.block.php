    
    <?php if ($submitted) : // if the form was submitted successfully ?>
    
        <div class="forms_block_submitted">
            <a name="<?= $name; ?>"></a>
            <?= $content; ?>
        </div>
            
    <?php elseif ($fields != '') : // else, display the form as long as there are fields ?>
    
        <div class="forms_block">
            <div class="<?= ($type == 'horizontal' ? 'form_horizontal' : '') ?>">
                <form id="<?= $name; ?>" action="<?= $action; ?>" method="post">
                    <?= $fields; ?>
                    <div class="form_actions">
                        <button type="submit" class="btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        
    <?php endif; ?>
    