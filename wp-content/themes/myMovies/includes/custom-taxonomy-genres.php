<?php

/**
 * Hook called on 'init' to create the taxonomy 'genres' for custom post type 'movies'
 */
add_action('init', 'create_taxonomy_genres');

/**
 * Add 'genre' taxonomy for custom post type 'movies'
 */
function create_taxonomy_genres() {
    register_taxonomy(
            'genres', 'movies', array(
        'hierarchical' => true,
        'label' => __('Genres'),
        'query_var' => 'genres',
        'rewrite' => array('slug' => 'genres')
            )
    );
}

