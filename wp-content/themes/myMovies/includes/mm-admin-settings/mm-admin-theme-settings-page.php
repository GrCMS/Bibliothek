<?php

add_action( 'admin_init', 'mm_register_theme_settings' );

function mm_register_theme_settings() {
    
    register_setting( 'mm-theme-settings-group', 'mm_show_best_rated_slider' );
    register_setting( 'mm-theme-settings-group', 'mm_show_most_rented_slider' );
}

?>

<div class="wrap">
<h2>myMovies Theme Settings</h2>

<form method="post" action="">
    
    <?php settings_fields( 'mm-theme-settings-group' ); ?>
    <?php do_settings_sections( 'mm-theme-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Show Slider: best rated on front page</th>
        <td><input type="checkbox" name="mm_show_best_rated_slider" id="mm_show_best_rated_slider" value="<?php echo get_option('mm_show_best_rated_slider'); ?>" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Show Slider: most rented on front page</th>
        <td><input type="checkbox" name="mm_show_most_rented_slider" id="mm_show_most_rented_slider" value="<?php echo get_option('mm_show_most_rented_slider'); ?>" /></td>
        </tr>
        
    </table>
    
    <?php submit_button(); ?>

</form>
</div>