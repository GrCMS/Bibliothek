<?php

function myMovies_theme_setup() {
    //Register main menu for current theme
    register_nav_menu('main', 'Main Navigation');

    //Allows post thumbnails
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'myMovies_theme_setup');

/**
 * Add custom post-type
 */
add_action('init', 'create_post_type_movies');

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
            'revisions')
            )
    );
}

/**
 * Add taxonomy for movies
 */
add_action('init', 'create_taxonomy_genres');

function create_taxonomy_genres() {
    register_taxonomy(
        'genres', 
        'movies', 
        array(
            'hierarchical' => true,
            'label' => __('Genres'),
            'query_var' => 'genres',
            'rewrite' => array('slug' => 'genres')
        )
    );
}

?>