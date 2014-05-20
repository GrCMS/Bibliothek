<?php

/**
 * Hook called on 'init' to create the custom post type 'movies'
 */
add_action('init', 'create_post_type_movies');

/**
 * Add custom post-type 'movies'
 */
function create_post_type_movies() {
    register_post_type('movies', array(
        'labels' => array(
            'name' => __('Movies'),
            'singular_name' => __('Movie')),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'movies'),
        'exclude_from_search' => false,
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'revisions',
            'comments')
        )
    );
}

