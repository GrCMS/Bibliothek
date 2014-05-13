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
    hide_editor();
}

/** 
 * Init hook 
 */

add_action('init', 'myMovies_init');

// Add custom image sizes
add_image_size( 'movie_poster', 685, 1000, true);

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

add_action( 'after_switch_theme', 'create_rentals_table' );

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

add_action("switch_theme", "drop_rentals_table"); 

/**
 * Creates the rentals table in the database
 */
function drop_rentals_table() {
    echo '<script type="text/javascript">alert("Des war deine falsche Entscheidung mein kleiner Sportsfreund!")</script>';
}

/**
 * Hides the content editor if an account page template is chosen
 * (WORK IN PROGRESS)
 */
function hide_editor() {

    $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
    if( !isset( $post_id ) ) return;
    $template_file = get_post_meta($post_id, '_wp_page_template', true);
            
    switch($template_file)
    {
        case 'template-bookmarks-page.php': {
       
            remove_post_type_support('page', 'editor');
            break;
        }
        
        case 'template-movies-on-loan-page.php': {
       
            remove_post_type_support('page', 'editor');
            break;
        }
        
        case 'template-my-profile-page.php': {
            
            remove_post_type_support('page', 'editor');
            break;
        }
        
        case 'template-notifications-page.php': {
            
            remove_post_type_support('page', 'editor');
            break;
        }
    }
}

?>