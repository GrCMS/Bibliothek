<?php

add_action( 'admin_init', 'mm_register_theme_settings' );

function mm_register_theme_settings() {
    
    register_setting( 'mm-theme-settings-group', 'mm_show_best_rated_slider' );
    register_setting( 'mm-theme-settings-group', 'mm_show_most_rented_slider' );
}

?>

<div class="wrap">
<h2>myMovies Theme Settings</h2>

<form method="POST" action="">
    
    <input type="hidden" name="update_themeoptions" value="true" />
    
    <h4><input type="checkbox" name="mm_show_best_rated_slider" id="mm_show_best_rated_slider" /> Display best rated slider</h4>
 
    <h4><input type="checkbox" name="mm_show_most_rented_slider" id="mm_show_most_rented_slider" /> Display most rented slider</h4>
    
    <p><input type="submit" name="search" value="Update Options" class="button" /></p>
    
</form>
</div>