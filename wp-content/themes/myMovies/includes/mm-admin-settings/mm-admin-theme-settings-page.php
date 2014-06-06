<?php

add_action( 'admin_init', 'mm_register_theme_settings' );

if ( $_POST['update_themeoptions'] == 'true' ) { themeoptions_update(); }

function mm_register_theme_settings() {
    
    register_setting( 'mm-theme-settings-group', 'mm_show_top_rated_slider' );
    register_setting( 'mm-theme-settings-group', 'mm_show_most_rented_slider' );
}

function themeoptions_update()
{
    if ($_POST['showtopratedslider']=='on') { $status = 'checked'; } else { $status = ''; }
        update_option('mm_show_top_rated_slider', $status);
    
    if ($_POST['showmostrentedslider']=='on') { $status = 'checked'; } else { $status = ''; }
        update_option('mm_show_most_rented_slider', $status);
}

?>

<div class="wrap">
<h2><?php echo __("myMovies theme settings", "myMovies"); ?></h2>

<form method="POST" action="">
    
    <input type="hidden" name="update_themeoptions" value="true" />
    
    <h4><input type="checkbox" name="showtopratedslider" id="showtopratedslider" <?php echo get_option('mm_show_top_rated_slider'); ?> /><?php echo __("Show top rated slider", "myMovies"); ?></h4>
 
    <h4><input type="checkbox" name="showmostrentedslider" id="showmostrentedslider" <?php echo get_option('mm_show_most_rented_slider'); ?> /><?php echo __("Show most rented slider", "myMovies"); ?></h4>
    
    <p><input type="submit" name="search" value="<?php echo __("Update settings", "myMovies"); ?>" class="button" /></p>
    
</form>
</div>