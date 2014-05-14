<?php

//Include custom nav walker for genre slider
require_once('genre-slider-walker.php');

function myMovies_theme_setup() {
    
    //Allows post thumbnails
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'myMovies_theme_setup');

/**
 * Init function
 */
function myMovies_init()
{
    create_post_type_movies();
    create_taxonomy_genres();
    register_menus();
}

/** 
 * Init hook 
 */

add_action('init', 'myMovies_init');

// Add custom image sizes
add_image_size( 'movie_poster', 263, 383, true);

/**
 * Register nav menus: 'genre slider', 'account navigation' and 'page navigation'
 */

function register_menus()
{
    register_nav_menus(array(

        'slider' => 'Genre Slider',
        'account' => 'Account Navigation',
        'page' => 'Page Navigation'
    ));
}

/**
 * Add custom post-type
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
            'revisions')
            )
    );
}

/**
 * Add taxonomy for movies
 */

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

add_action( 'after_switch_theme', 'create_tables' );


function create_tables() {
    create_rentals_table();
    create_ratings_table();
}
/**
 * Creates the rentals table in the database
 */
function create_rentals_table() {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'rentals';
    
    $sql = "CREATE TABLE $table_name (
            id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            user int(11),
            movie int(11),
            rental_date date,
            return_date date,
            returned int(1) DEFAULT 0);";
            
    require_once(ABSPATH.'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

/**
 * Creates the rentals table in the database
 */
function create_ratings_table() {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'ratings';
    
    $sql = "CREATE TABLE $table_name (
            user int(11) NOT NULL,
            movie int(11) NOT NULL,
            rating int(11),
            PRIMARY KEY(user,movie));";
            
    require_once(ABSPATH.'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

add_action("switch_theme", "drop_rentals_table"); 

/**
 * Creates the rentals table in the database
 */
function drop_rentals_table() {
    echo '<script type="text/javascript">alert("Des war deine falsche Entscheidung mein kleiner Sportsfreund!")</script>';
}

?>