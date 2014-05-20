<?php

add_filter('wp_nav_menu_items', 'add_cpt_movies_archive_link', 10, 2);

function add_cpt_movies_archive_link($items, $args) {
    if ($args->theme_location == 'slider') {
        $movies_archive_link = get_post_type_archive_link( 'movies' );
        $movie_link = '<a href="' . $movies_archive_link .'">All movies</a>';
        $items .= '<li>' . $movie_link . '</li>';
    }
    return $items;
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