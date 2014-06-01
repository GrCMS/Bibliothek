<?php

//print_r($_POST);
$customvaulue = new customValue();
//echo $_POST['fp_headline'];

if(count($_POST) > 0){
    
    $customvaulue->setValue('Frontpage Headline', $_POST['fp_headline']);
    $customvaulue->setValue('Frontpage Subheadline', $_POST['fp_subheadline']);
    $customvaulue->setValue('Frontpage Text', $_POST['fp_welcometext']);
}

// Default values
$customvaulue->createIdentifier('Frontpage Headline', 'myMovies Headline');
$customvaulue->createIdentifier('Frontpage Subheadline', 'myMovies Subheadline');
$customvaulue->createIdentifier('Frontpage Text', 'myMovies welcome text.');

$allvalues = $customvaulue->getAllValues();

?>

<div class="wrap">
    <h2><?php echo __('Frontapage text', 'myMovies'); ?></h2>
    <form id="mm_values_form" action="<?php the_permalink(); ?>" method="POST">
        
        <input name="action" type="hidden" value="update" />
        <input name="page_options" type="hidden" value="fp_headline,fp_subheadline,fp_welcometext" />
    
        <table class="wp-list-table widefat fixed">
            <thead>
                <tr>
                    <th class="column-identifier">
                        <?php echo __('Item', 'myMovies'); ?>
                    </th>

                    <th>
                        <?php echo __('Value', 'myMovies'); ?>
                    </th>
                </tr>
            </thead>
            <tr>
                <td><label for='fp_headline'><?php echo __('Frontpage Headline', 'myMovies'); ?></label></td>
                <td><input type='text' name='fp_headline' id='fp_headline' value='<?php echo $customvaulue->getValue('Frontpage Headline')?>'></td>
            </tr>

            <tr>
                <td><label for='fp_subheadline'><?php echo __('Frontpage Subheadline', 'myMovies'); ?></label></td>
                <td><input type='text' name='fp_subheadline' id='fp_subheadline' value='<?php echo $customvaulue->getValue('Frontpage Subheadline')?>'></td>
            </tr>

            <tr>
                <td><label for='fp_welcometext'><?php echo __('Frontpage welcome text', 'myMovies'); ?></label></td>
                <td><textarea type='text' name='fp_welcometext' rows="7" id='fp_welcometext' style="width: 100%"><?php echo $customvaulue->getValue('Frontpage Text')?></textarea></td>
            </tr>

        </table>
    
        <div class="tablenav bottom">
            <input type="submit" class="button action" value="<?php echo __('Apply', 'myMovies'); ?>">
        </div>
    
    </form>

</div>
