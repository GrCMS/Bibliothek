<?php

/**
 * Add ajax bookmark hook and handle requests
 */

add_filter('wp_ajax_mm_movie_post_loader', 'mm_movie_post_loader');
add_filter('wp_ajax_nopriv_mm_movie_post_loader', 'mm_movie_post_loader');
        
function mm_movie_post_loader()
{
    $numPosts = (isset($_GET['numPosts'])) ? $_GET['numPosts'] : 0;
    $page = (isset($_GET['pageNumber'])) ? $_GET['pageNumber'] : 0;
    $post_args_json = (isset($_GET['args'])) ? $_GET['args'] : null;
    
    $args = array( 
        
        'posts_per_page' => $numPosts,
        'paged' => $page,
        'post_type' => 'movies'
    );
    
    if($post_args_json != null)
    {
        $query_args = array_merge($args, $post_args_json);
        $movie_query = new WP_Query($query_args);
    
    } else {
        
        $movie_query = new WP_Query($args);
    }
    
    while($movie_query->have_posts()) : $movie_query->the_post();
                           
        get_template_part( 'templates/template', 'movie' );
        echo '<div class="movie-divider"></div>';
        
    endwhile;
    wp_reset_query();
}

