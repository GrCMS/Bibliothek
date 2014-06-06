<?php

//Include custom nav walker for genre slider
include_once('includes/genre-slider-walker.php');

//Include bookmarks ajax service
include_once('includes/bookmarks-service.php');

//Include ratings ajax service
include_once('includes/ratings-service.php');

//Include movie post loader ajax service
include_once('includes/movie-post-loader-service.php');

//Include movie post loader ajax service
include_once('includes/movie-rental-service.php');

//Include custom menu registration in order to user custom menus
include_once('includes/custom-menu-registration.php');

//Include custom menu items (logout, custom-post-tpye 'movies')
include_once('includes/custom-menu-items.php');

//Include custom post type 'movies'
include_once('includes/custom-post-type-movies.php');

//Include custom taxonomy 'genres' for custom post type 'movies'
include_once('includes/custom-taxonomy-genres.php');

//Include script registration in order to add styles and scripts to the theme
include_once('includes/script-registration.php');

//Include script backend custom menu
include_once('includes/custom-backend-menu.php');

//Include admin backend custom settings
include_once('includes/mm-admin-settings/mm-admin-settings.php');

//Include Advanced Custom Fields and hide in Backend
define('ACF_LITE', true);
include_once('includes/advanced-custom-fields/acf.php');

/**
 * Hook called on 'after_setup_theme' to add settings after the theme has been activated
 */
add_action('after_setup_theme', 'myMovies_theme_setup');

function myMovies_theme_setup() {
    // Load language files
    load_theme_textdomain('myMovies', get_template_directory() . '/languages');

    //include(get_template_directory() . '/languages/myMovies-de_DE.po');
    //Allows post thumbnails
    add_theme_support('post-thumbnails');
}

// Add custom image sizes
add_image_size('movie_poster', 263, 383, true);

/**
 * Add filter to always remove the admin bar
 */
add_filter('show_admin_bar', '__return_false');

add_action('after_switch_theme', 'create_tables');

function create_tables() {
    create_rentals_table();
    //create_mymovies_admin_table();
}

/**
 * Creates the rentals table in the database
 */
function create_rentals_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'rentals';

    $sql = 'CREATE TABLE ' . $table_name . ' (
            id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            user int(11),
            movie int(11),
            rental_date date,
            return_date date,
            returned_date date,
            returned int(1) DEFAULT 0);';

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
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

add_action('template_redirect', 'register_a_user');

/**
 * Own custom user registration
 */
function register_a_user() {
    if (isset($_GET['do']) && $_GET['do'] == 'register'):
        $errors = array();
        /* Check if nonce is verified */
        if(isset($_POST['register-nonce']) && wp_verify_nonce($_POST['register-nonce'], 'register-user')) {
            if (empty($_POST['user']) || empty($_POST['email']))
            $errors[] = __('provide a user and email');
            if (!empty($_POST['spam']))
                $errors[] = __('gtfo spammer');

            $user_login = esc_attr($_POST['user']);
            $user_email = esc_attr($_POST['email']);
            require_once(ABSPATH . WPINC . '/registration.php');

            $sanitized_user_login = sanitize_user($user_login);
            $user_email = apply_filters('user_registration_email', $user_email);

            if (!is_email($user_email))
                $errors[] = __('invalid e-mail');
            elseif (email_exists($user_email))
                $errors[] = __('this email is already registered, bla bla...');

            if (empty($sanitized_user_login) || !validate_username($user_login))
                $errors[] = __('invalid user name');
            elseif (username_exists($sanitized_user_login))
                $errors[] = __('user name already exists');

            if (empty($errors)):
                $user_pass = wp_generate_password();
                $user_id = wp_create_user($sanitized_user_login, $user_pass, $user_email);

                if (!$user_id):
                    $errors[] = __('registration failed...');
                else:
                    update_user_option($user_id, 'default_password_nag', true, true);
                    wp_new_user_notification($user_id, $user_pass);
                endif;
            endif;

            if (!empty($errors))
                define('REGISTRATION_ERROR', serialize($errors));
            else
                define('REGISTERED_A_USER', $user_email);
        } else {
            $errors[] = __('Request does not come from this site. Registration interrupted.');
        }
        
    endif;
}

/**
 * Creates a shortcode new_movies with attribute count
 */
add_shortcode('new_movies', 'new_movies_shortcode');

function new_movies_shortcode($atts) {
    $a = shortcode_atts(array(
        'count' => '10',
            ), $atts);

    $args = array(
        'post_type' => 'movies',
        'posts_per_page' => intval($a['count']),

    );
    
    ob_start();
    $movie_query = new WP_Query($args);
    
    echo "<div class='container text-center'>";
    echo "<div style='margin: auto; max-width:960px'>";
        
    while($movie_query->have_posts()) : $movie_query->the_post();
                           
        get_template_part( 'templates/template', 'movie-shortcode' );
        
    endwhile;
    
    echo "</div>";
    echo "</div>";
    echo "<span class='clearfix'></span>";
    
    $ret = ob_get_contents();
    ob_end_clean();
    
    return $ret; 
}

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_movies',
		'title' => 'Movies',
		'fields' => array (
			array (
				'key' => 'field_536e0814c680b',
				'label' => 'Subtitle',
				'name' => 'subtitle',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'Enter subtitle here',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_536e085fc680c',
				'label' => 'Year',
				'name' => 'year',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_536e08f0c680d',
				'label' => 'Studio',
				'name' => 'studio',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'movies',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

?>
