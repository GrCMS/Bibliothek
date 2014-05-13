<?php

//Include custom nav walker for genre slider
require_once('genre-slider-walker.php');

function myMovies_theme_setup() {
    
    //Register menus (genre slider, account navigation and page navigation) for current theme
    register_nav_menus(array(

        'slider' => 'Genre slider',
        'account' => 'Account navigation',
        'page' => 'Page navigation'
    ));

    //Allows post thumbnails
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'myMovies_theme_setup');


// Add custom image sizes
add_image_size( 'movie_poster', 685, 1000, true);

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