<?php

/**
 * Template called for custom post type 'movies'
 */

get_header();

?>

<?php 

    $args = array(
        
        'post_type' => 'movies'
    );
    
    $args_json = json_encode($args);

?>

<input type="hidden" id="mm_query_args" value='<?php echo $args_json ?>'>

<div id="mm-movies-posts">
    
    <h3 class="container color-primary"><?php echo __('All movies', 'myMovies'); ?></h3>
    
</div>

<div id="mm-movie-ajax-loading" class="container text-center">
    
    <span><?php echo __("Loading movies...", "myMovies"); ?></span><br/>
    <span class="ion-loading-c" id="mm-all-movie-ajax-loading-icon"></span>
    
</div>
    
<?php 

get_footer();

?>

