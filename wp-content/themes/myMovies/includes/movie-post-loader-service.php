<?php

/**
 * Add ajax bookmark hook and handle requests
 */

add_filter('wp_ajax_mm_movie_post_loader', 'mm_movie_post_loader');
        
function mm_movie_post_loader()
{
    $numPosts = (isset($_GET['numPosts'])) ? $_GET['numPosts'] : 0;
    $page = (isset($_GET['pageNumber'])) ? $_GET['pageNumber'] : 0;
    
    $args = array( 
        
        'posts_per_page' => $numPosts,
        'paged' => $page,
        'post_type' => 'movies' 
    );
    
    $posts = get_posts($args);
    
    foreach($posts as $movie)
    {
        setup_postdata($movie);
        get_template_part( 'templates/movie', 'template' );
    }
    
    wp_reset_postdata();
}

