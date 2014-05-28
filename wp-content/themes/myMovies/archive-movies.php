<?php

/**
 * Template called for custom post type 'movies'
 */

get_header();

?>

<style>
    
    #mm-all-movie-ajax-loading-icon {
        
        font-size: 30px;
        color: #1c2a2b;
        margin-top:10px;
        margin-bottom: 30px;
    }
    
</style>

<div id="mm-all-movies-posts">
    
    <h3 class="container color-primary"><?php echo __('All movies', 'myMovies'); ?></h3>
    
</div>

<div id="mm-all-movie-ajax-loading" class="container text-center">
    
    <span><?php echo __("Loading movies...", "myMovies"); ?></span><br/>
    <span class="ion-loading-c" id="mm-all-movie-ajax-loading-icon"></span>
    
</div>



    
<?php 

get_footer();

?>

