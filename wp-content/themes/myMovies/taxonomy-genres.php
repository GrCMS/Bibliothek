<?php get_header(); ?>

<?php

$term = $wp_query->queried_object;

$args = array(
    'genres' => $term->name,
    'post_type' => 'movies',
    'post_status' => 'publish',
    'posts_per_page' => 6
);

$args_json = json_encode($args);

?>

<input type="hidden" id="mm_query_args" value='<?php echo $args_json ?>'>

<div id="mm-movies-posts">

    <h4 class="container">Genres</h4>
    <?php
        echo '<h3 class="container color-primary large">'.$term->name.'</h3>';
    ?>

</div>

<div id="mm-movie-ajax-loading" class="container text-center">

    <span><?php echo __("Loading movies...", "myMovies"); ?></span><br/>
    <span class="ion-loading-c" id="mm-all-movie-ajax-loading-icon"></span>

</div>
    

<?php get_footer(); ?>