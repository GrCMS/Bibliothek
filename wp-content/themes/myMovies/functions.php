<?php

//Include custom nav walker for genre slider
require_once('genre-slider-walker.php');
include_once('includes/bookmarks-service.php');
include_once('includes/ratings-service.php');

function myMovies_theme_setup() {

    //Allows post thumbnails
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'myMovies_theme_setup');

/**
 * Init function
 */
function myMovies_init() {
    create_post_type_movies();
    create_taxonomy_genres();
    register_menus();
}

/**
 * Init hook 
 */
add_action('init', 'myMovies_init');

// Add custom image sizes
add_image_size('movie_poster', 263, 383, true);

/**
 * Register nav menus: 'genre slider', 'account navigation' and 'page navigation'
 */
function register_menus() {
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
            'genres', 'movies', array(
        'hierarchical' => true,
        'label' => __('Genres'),
        'query_var' => 'genres',
        'rewrite' => array('slug' => 'genres')
            )
    );
}

add_action('after_switch_theme', 'create_tables');

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

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
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

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

add_action("switch_theme", "drop_rentals_table");

/**
 * Creates the rentals table in the database
 */
function drop_rentals_table() {
    echo '<script type="text/javascript">alert("Des war deine falsche Entscheidung mein kleiner Sportsfreund!")</script>';
}

add_action('admin_init', 'restrict_admin', 1);

function restrict_admin() {
    if (!current_user_can('manage_options') && '/wp-admin/admin-ajax.php' != $_SERVER['PHP_SELF']) {
        wp_redirect(site_url());
    }
}

add_action('wp_login_failed', 'movies_login_failed'); // hook failed login

function movies_login_failed($user) {
    // check what page the login attempt is coming from
    $referrer = $_SERVER['HTTP_REFERER'];

    // check that were not on the default login page
    if (!empty($referrer) && !strstr($referrer, 'wp-login') && !strstr($referrer, 'wp-admin') && $user != null) {
        // make sure we don't already have a failed login attempt
        if (!strstr($referrer, '?login=failed')) {
            // Redirect to the login page and append a querystring of login failed
            wp_redirect(site_url() . '/login?login=failed');
        } else {
            wp_redirect($referrer);
        }

        exit;
    }
}

add_action('authenticate', 'movies_blank_login');

function movies_blank_login($user) {
    // check what page the login attempt is coming from
    $referrer = $_SERVER['HTTP_REFERER'];

    $error = false;

    if ($_POST['log'] == '' || $_POST['pwd'] == '') {
        $error = true;
    }

    // check that were not on the default login page
    if (!empty($referrer) && !strstr($referrer, 'wp-login') && !strstr($referrer, 'wp-admin') && $error) {

        // make sure we don't already have a failed login attempt
        if (!strstr($referrer, '?login=failed')) {
            // Redirect to the login page and append a querystring of login failed
            wp_redirect(site_url() . '/login?login=failed');
        } else {
            wp_redirect($referrer);
        }

        exit;
    }
}

add_filter('login_redirect', 'redirect_user');

function redirect_user() {
    $referrer = $_SERVER['HTTP_REFERER'];

    if (!strstr($referrer, 'wp-login')) {
        if (!strstr($referrer, 'login'))
            return $referrer;
        else
            return site_url();
    } else {
        return site_url() . '/wp-admin';
    }
}

add_filter('wp_nav_menu_items', 'add_logout_link', 10, 2);

function add_logout_link($items, $args) {
    if ($args->theme_location == 'account') {
        $loginoutlink = wp_loginout('index.php', false);
        if (current_user_can('administrator')) {
            $backendlink = '<a href="' . site_url() . '/wp-admin">Backend</a>';
            $items .= '<li>' . $backendlink . '</li>';
        }
        $items .= '<li>' . $loginoutlink . '</li>';
    }
    return $items;
}

/**
 * Function to enqueue scripts and styles
 * Also needen for ajax script and service localization 
 */
add_action("wp_enqueue_scripts", "mm_enqueue_scripts");

function mm_enqueue_scripts() {
    //Style registration
    wp_register_style('icomoon', get_template_directory_uri() . '/fonts/icomoon/style.css', array(), '1.0', false);
    wp_register_style('ionicons', get_template_directory_uri() . '/css/ionicons.min.css', array(), '1.0', false);
    wp_register_style('style', get_stylesheet_uri());
    wp_register_style('stars', get_template_directory_uri() . '/css/stars.css', array(), '1.0', false);
    wp_register_style('bootstrap-style', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css', array(), '3.1.1', false);
    wp_register_style('genre-slider-style', get_template_directory_uri() . '/css/genre-slider.css', array(), '1.0', false);
    wp_register_style('flexslider-style', get_template_directory_uri() . '/css/flexslider.css', array(), '1.0', false);

    //Script registration
    wp_register_script('bootstrap-js', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array('jquery'), '3.1.1', true);
    wp_register_script('enquire-js', get_template_directory_uri() . '/js/enquire.min.js', array('jquery'), '2.1.0', true);
    wp_register_script('toggle-navigation-js', get_template_directory_uri() . '/js/mm-toggle-navigation.js', array('jquery'), '1.0', true);
    wp_register_script('genre-slider-js', get_template_directory_uri() . '/js/mm-genre-slider.js', array('jquery'), '1.0', true);
    wp_register_script('bookmarks-js', get_template_directory_uri() . '/js/ajax/bookmarks.js', array('jquery'), '1.0', true);
    wp_register_script('ratings-js', get_template_directory_uri() . '/js/ajax/ratings.js', array('jquery'), '1.0', true);
    wp_register_script('raty-js', get_template_directory_uri() . '/js/raty/jquery.raty.min.js', array('jquery'), '2.5.2', true);
    wp_register_script('mymovies-js', get_template_directory_uri() . '/js/mymovies.js', array('jquery'), '1.0', true);
    wp_register_script('flexslider-js', get_template_directory_uri() . '/js/jquery.flexslider.js', array('jquery'), '1.0', true);
    wp_register_script('mm-bookmark-list-js', get_template_directory_uri() . '/js/mm-bookmark-list.js', array('jquery'), '1.0', true);

    //localization for ajax scripts
    wp_localize_script('bookmarks-js', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php')));
    wp_localize_script('ratings-js', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php')));
    
    //Always enqueue jQuery
    wp_enqueue_script('jquery');

    if (!is_admin()) {
        //Only enqueued on frontend (JS)
        wp_enqueue_script('bootstrap-js');
        wp_enqueue_script('enquire-js');
        wp_enqueue_script('toggle-navigation-js');
        wp_enqueue_script('genre-slider-js');
        wp_enqueue_script('raty-js');
        wp_enqueue_script('mm-bookmark-list-js');
        
        //Only enqueued on frontend (AJAX)
        wp_enqueue_script('bookmarks-js');
        wp_enqueue_script('ratings-js');

        //Only enqueued on frontend (CSS)
        wp_enqueue_style('icomoon');
        wp_enqueue_style('ionicons');
        wp_enqueue_style('style');
        wp_enqueue_style('stars');
        wp_enqueue_style('bootstrap-style');
        wp_enqueue_style('genre-slider-style');

        if (is_front_page()) {
            
            //Only enqueued on front page (front-page.php)
            wp_enqueue_style('flexslider-style');
            wp_enqueue_script('flexslider-js');
            wp_enqueue_script('mymovies-js');
        }
    }
}

/**
 * Add hook to always remove the admin bar
 */
add_filter('show_admin_bar', '__return_false');

add_action('template_redirect', 'register_a_user');

/**
 * Own custom user registration
 */
function register_a_user() {
    if (isset($_GET['do']) && $_GET['do'] == 'register'):
        $errors = array();
        if (empty($_POST['user']) || empty($_POST['email']))
            $errors[] = 'provide a user and email';
        if (!empty($_POST['spam']))
            $errors[] = 'gtfo spammer';

        $user_login = esc_attr($_POST['user']);
        $user_email = esc_attr($_POST['email']);
        require_once(ABSPATH . WPINC . '/registration.php');

        $sanitized_user_login = sanitize_user($user_login);
        $user_email = apply_filters('user_registration_email', $user_email);

        if (!is_email($user_email))
            $errors[] = 'invalid e-mail';
        elseif (email_exists($user_email))
            $errors[] = 'this email is already registered, bla bla...';

        if (empty($sanitized_user_login) || !validate_username($user_login))
            $errors[] = 'invalid user name';
        elseif (username_exists($sanitized_user_login))
            $errors[] = 'user name already exists';

        if (empty($errors)):
            $user_pass = wp_generate_password();
            $user_id = wp_create_user($sanitized_user_login, $user_pass, $user_email);

            if (!$user_id):
                $errors[] = 'registration failed...';
            else:
                update_user_option($user_id, 'default_password_nag', true, true);
                wp_new_user_notification($user_id, $user_pass);
            endif;
        endif;

        if (!empty($errors))
            define('REGISTRATION_ERROR', serialize($errors));
        else
            define('REGISTERED_A_USER', $user_email);
    endif;
}

if (!function_exists('my_pagination')) :

    function my_pagination() {
        global $wp_query;

        $big = 999999999; // need an unlikely integer

        echo paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total' => $wp_query->max_num_pages
        ));
    }

endif;
?>
