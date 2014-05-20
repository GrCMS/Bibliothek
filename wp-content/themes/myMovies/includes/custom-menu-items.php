<?php

/**
 * Hook called on 'wp_nav_menu_items' in order to render a link to the custom post type archive for 'movies'
 */
add_filter('wp_nav_menu_items', 'add_cpt_movies_archive_link', 10, 2);

/**
 * Adds the 'All Movies' link to the genre slider (archive-movies.php)
 * ATTENTION: This is just a workaround. The link will not show up in the backend.
 */
function add_cpt_movies_archive_link($items, $args) {
    if ($args->theme_location == 'slider') {
        $movies_archive_link = get_post_type_archive_link( 'movies' );
        $movie_link = '<a href="' . $movies_archive_link .'">All movies</a>';
        $items .= '<li>' . $movie_link . '</li>';
    }
    return $items;
}

/**
 * Hook called on 'wp_nav_menu_items' in order to render a logout and backend link
 */
add_filter('wp_nav_menu_items', 'add_logout_link', 10, 2);

/**
 * Adds the 'logout' and 'backend' link to the account menu
 */
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